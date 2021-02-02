import React from 'react';

import './bootstrap.min.css';
import './App.css';


import { Switch, Route } from 'react-router-dom';

// Components
import Navbar from './components/Navbar';

// Pages
import home from './pages/home';

import post from './pages/post/post';
import createPost from './pages/post/createPost';
import editPost from './pages/post/editPost';

import login from './pages/auth/login';
import register from './pages/auth/register';

import notFount from './pages/notFount';

function App() {
  return (
      <div className="App">
          <React.Fragment>
              <Navbar />
              <Switch>
                  <Route exact path="/" component={home} />
                  <Route exact path="/post" component={post} />
                  <Route exact path="/post/create" component={createPost} />
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
