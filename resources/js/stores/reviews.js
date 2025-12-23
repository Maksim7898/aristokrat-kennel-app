import {defineStore} from 'pinia'
import {reviews as initialReviews} from '@/data/reviews'

export const useReviewsStore = defineStore('reviews', {
    state: () => ({
        reviews: [...initialReviews]
    }),
    getters: {
        reviewsByCat: (state) => (slug) =>
            state.reviews.filter((review) => review.slug === slug)
    },
    actions: {
        addReview(review) {
            this.reviews.unshift({
                id: Date.now(),
                ...review
            })
        }
    }
})
