import React from 'react';

import './bootstrap.min.css';
import './App.css';

import { Switch, Route } from 'react-router-dom';

// Components
import Navbar from './components/Navbar';

// Pages
import home from './pages/home';

import posts from './pages/post/posts';
import createPost from './pages/post/createPost';
import editPost from './pages/post/editPost';
import postDeletedSuccess from './pages/post/postDeletedSuccess';

import login from './pages/auth/login';
import register from './pages/auth/register';

import notFount from './pages/notFount';
import axios from 'axios';
axios.defaults.baseURL = 'http://localhost:8083';

function App() {
  return (
      <div className="App">
          <React.Fragment>
              <Navbar />
              <Switch>
                  <Route exact path="/" component={home} />
                  <Route exact path="/post" component={posts} />
                  <Route exact path="/post/create" component={createPost} />
                  <Route exact path="/post/deleted" component={postDeletedSuccess} />
                  <Route exact path="/post/:id" component={editPost} />
                  <Route exact path="/auth/login" component={login} />
                  <Route exact path="/auth/register" component={register} />
                  <Route component={notFount} />
              </Switch>
          </React.Fragment>
      </div>
  );
}

export default App;
