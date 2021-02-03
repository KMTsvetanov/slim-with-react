import {
    SET_POSTS,
    POST_POST,
    EDIT_POST,
    CLEAR_ERRORS,
    LOADING_DATA,
    SET_ERRORS
} from '../types';

import axios from 'axios';

// Ger all Posts
export const getPosts = () => dispatch => {
    dispatch({type: LOADING_DATA});

    axios.get('/post')
        .then(res => {
            dispatch({type: SET_POSTS, payload: res.data.data});
        })
        .catch(err => {
            dispatch({type: SET_POSTS, payload: []})
        })
}

// Save a Post
export const savePosts = (newPost, history) => dispatch => {
    dispatch({type: LOADING_DATA});

    let formData = new FormData();

    formData.append('title', newPost.title);
    formData.append('content', newPost.content);
    formData.append('image', newPost.image);


    let token = localStorage.getItem('token')
    if (token) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
            }
        }
        axios.post('/post', formData, config)
            .then(res => {
                dispatch({type: POST_POST, payload: res.data.data});
                dispatch(clearErrors());
                history.push('/post');
            })
            .catch(err => {
                dispatch({type: SET_ERRORS, payload: err.response.data})
            })
    }
}

// Edit a Post
export const editPosts = (id, postData, history) => dispatch => {
    dispatch({type: LOADING_DATA});

    let formData = new FormData();

    formData.append('title', postData.title);
    formData.append('content', postData.content);
    formData.append('image', postData.image);
    formData.append('_method', 'PUT');

    let token = localStorage.getItem('token')
    if (token) {
        const config = {
            headers: {
                'content-type': 'multipart/form-data',
                'Authorization': `Bearer ${token}`
            }
        }

        axios.post(`/post/${id}/edit`, formData, config)
            .then(res => {
                dispatch({type: EDIT_POST, payload: res.data.data});
                dispatch(clearErrors());
                history.push('/post');
            })
            .catch(err => {
                dispatch({type: SET_ERRORS, payload: err.response.data})
            })
    }
}

export const clearErrors = () => dispatch => {
    dispatch({type: CLEAR_ERRORS});
}