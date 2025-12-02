export class AuthClient {
    constructor() {
        this.accessToken = localStorage.getItem('access_token');
        this.tokenExpiry = localStorage.getItem('token_expires');
    }

    async login(identity, password, remember = false) {
        const formData = new FormData();
        formData.append('email', identity);
        formData.append('password', password);
        formData.append('remember', remember);

        const response = await fetch(document.baseURI + 'auth/login', {
            method: 'POST',
            body: formData,
            credentials: 'include'
        });

        if (!response.ok) {
            let errorMessage = `Error ${response.status}`;
            try {
                const errorData = await response.json();
                errorMessage = errorData.message || errorData.error || errorMessage;
            } catch (e) {
                errorMessage = await response.text() || errorMessage;
            }
            throw new Error(response.status + ':' + errorMessage);
        }

        const data = await response.json();
        this.setTokens(data);
        return data;
    }

    setTokens(data) {
        this.accessToken = data.access_token;
        this.tokenExpiry = Date.now() + (data.expires_in * 1000);
        localStorage.setItem('access_token', this.accessToken);
        localStorage.setItem('token_expires', this.tokenExpiry);
    }

    async refreshToken() {
        const response = await fetch('/auth/refresh', {
            method: 'POST',
            credentials: 'include'
        });

        if (!response.ok) {
            this.logout();
            throw new Error('Refresh failed');
        }

        const data = await response.json();
        this.setTokens(data);
        return data;
    }

    logout() {
        localStorage.removeItem('access_token');
        localStorage.removeItem('token_expires');
        this.accessToken = null;
        this.tokenExpiry = null;
        // Opcional: llamar a /auth/logout para revocar refresh token
    }

    async fetch(url, options = {}) {
        if (this.tokenExpiry && Date.now >= this.tokenExpiry - 30000) {
            await this.refreshToken();
        }

        options.headers = {
            ...options.headers,
            'Authorization': `Bearer ${this.accessToken}`
        };

        options.credentials = 'include';

        let response = await fetch(url, options);

        if (response.status === 401) {
            await this.refreshToken();
            options.headers['Authorization'] = `Bearer ${this.accessToken}`;
            response = await this.fetch(url, options);
        }

        return response;
    }

    isAuthenticated() {
        return this.accessToken && Date.now() < this.tokenExpiry;
    }
}

export const auth = new AuthClient();