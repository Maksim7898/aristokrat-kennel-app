import {defineStore} from 'pinia'
import axios from 'axios'

const TOKEN_KEY = 'auth_token'

const extractUser = (payload) => {
    if (!payload) {
        return null
    }
    if (payload.data) {
        return payload.data
    }
    return payload
}

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem(TOKEN_KEY) || '',
        loading: false,
        ready: false
    }),
    getters: {
        isAuthenticated: (state) => Boolean(state.token)
    },
    actions: {
        applyToken(token) {
            this.token = token
            if (token) {
                localStorage.setItem(TOKEN_KEY, token)
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
            } else {
                localStorage.removeItem(TOKEN_KEY)
                delete axios.defaults.headers.common.Authorization
            }
        },
        async init() {
            if (this.ready) {
                return
            }
            this.ready = true
            if (this.token) {
                this.applyToken(this.token)
                await this.fetchMe()
            }
        },
        async fetchMe() {
            try {
                const {data} = await axios.get('/api/me')
                this.user = extractUser(data)
            } catch (error) {
                this.user = null
                this.applyToken('')
            }
        },
        async login(payload) {
            this.loading = true
            try {
                const {data} = await axios.post('/api/login', payload)
                this.applyToken(data.token)
                this.user = extractUser(data.user)
                return {ok: true}
            } catch (error) {
                return this.handleError(error)
            } finally {
                this.loading = false
            }
        },
        async register(payload) {
            this.loading = true
            try {
                const {data} = await axios.post('/api/register', payload)
                this.applyToken(data.token)
                this.user = extractUser(data.user)
                return {ok: true}
            } catch (error) {
                return this.handleError(error)
            } finally {
                this.loading = false
            }
        },
        async logout() {
            try {
                await axios.post('/api/logout')
            } catch (error) {
                // Ignore logout errors so we can still clear local session.
            } finally {
                this.user = null
                this.applyToken('')
            }
        },
        handleError(error) {
            const response = error?.response?.data
            const errors = response?.errors || {}
            return {
                ok: false,
                message: response?.message || 'Не удалось выполнить запрос.',
                errors
            }
        }
    }
})
