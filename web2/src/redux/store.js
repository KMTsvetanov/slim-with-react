import { combineReducers, compose, createStore, applyMiddleware} from 'redux';
import thunk from 'redux-thunk';

import postReducer from './reducers/PostReducer';

const initialState = {};

const middleware = [thunk]

const reducers = combineReducers({
    posts: postReducer
});

const store = createStore(reducers, initialState, compose(
    applyMiddleware(...middleware),
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
    )
);

export default store;