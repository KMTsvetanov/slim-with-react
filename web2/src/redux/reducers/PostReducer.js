import {
    SET_POSTS,
    POST_POST,
    SET_ERRORS,
    CLEAR_ERRORS,
    LOADING_DATA, EDIT_POST
} from '../types';

const initialState = {
    posts: [],
    post: {},
    errors: null,
    loading: false
}

export default function (state = initialState, action) {
    switch (action.type) {
        case SET_ERRORS:
            return {
                ...state,
                loading: false,
                errors: action.payload.message
            };

        case LOADING_DATA:
            return {
                ...state,
                loading: true,
            };

        case SET_POSTS:
            return {
                ...state,
                loading: false,
                posts: action.payload
            };

        case POST_POST:
            return {
                ...state
            };

        case CLEAR_ERRORS:
            return {
                ...state,
                loading: false,
                errors: null
            };
        case EDIT_POST:
            return {
                ...state
            }
        default:
            return state;
    }
}