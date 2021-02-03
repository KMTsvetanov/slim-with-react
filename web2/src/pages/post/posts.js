import React, {Component, Fragment} from 'react';
import PropTypes from "prop-types"

// Redux
import { connect } from 'react-redux';
import { getPosts } from "../../redux/actions/postActions";

// Components
import PostsColumns from '../../components/post/PostsColumns';
import PostsList from '../../components/post/PostsList';
import {Link} from "react-router-dom";

class Posts extends Component {
    state = {
        modeOpen: true,
        postId: null
    }

    componentDidMount() {
        this.props.getPosts();
    }

    render() {
        const { posts, loading } = this.props.data;
        const postsMarkup = !loading ? (posts.map(item =>
            <PostsList
                key={item.id}
                post={item}
            ></PostsList> )) : (
            <div className="py-5">
                <div className="col-10 mx-auto text-center">Loading data...</div>
            </div>
        );
        return (
            <Fragment>
                <div className="py-5">
                    <div className="col-10 mx-auto text-center">
                        <h1>
                            Posts <span className="px-2"></span>
                            { localStorage.getItem('token') ? (
                                <Link to="/post/create" className="btn btn-primary">
                                    Create
                                </Link>
                            ) : null}
                        </h1>
                    </div>
                    <PostsColumns />
                    {postsMarkup}
                </div>
            </Fragment>
        );
    }
}

Posts.propTypes = {
    data: PropTypes.object.isRequired,
    getPosts: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    data: state.posts
});

const mapDispatchToProps = {
    getPosts
};

export default connect(mapStateToProps, mapDispatchToProps)(Posts);