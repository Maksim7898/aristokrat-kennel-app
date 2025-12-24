import {defineStore} from 'pinia'
import axios from 'axios'

export const useReviewsStore = defineStore('reviews', {
    state: () => ({
        reviewsBySlug: {},
        loading: false
    }),
    getters: {
        reviewsByCat: (state) => (slug) =>
            state.reviewsBySlug[slug] || []
    },
    actions: {
        async fetchReviews(slug) {
            if (!slug) {
                return
            }
            this.loading = true
            try {
                const {data} = await axios.get(`/api/cats/${slug}/reviews`)
                const reviews = Array.isArray(data?.data) ? data.data : data
                this.reviewsBySlug = {
                    ...this.reviewsBySlug,
                    [slug]: reviews
                }
            } catch (error) {
                this.reviewsBySlug = {
                    ...this.reviewsBySlug,
                    [slug]: []
                }
            } finally {
                this.loading = false
            }
        },
        async submitReview(slug, payload) {
            const {data} = await axios.post(`/api/cats/${slug}/reviews`, payload)
            return data
        }
    }
})
