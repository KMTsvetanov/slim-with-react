import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import { FaEdit, FaTrashAlt } from 'react-icons/fa';
import axios from "axios";

class PostsList extends Component {

    render() {
        const { id, title, content, image } = this.props.post;

        function deletePost(e, id) {
            let token = localStorage.getItem('token')
            if(token){
                const config = {
                    headers: { 'Authorization':`Bearer ${token}` }
                }
                axios.delete(`/post/${id}`, config).then(res => {})
            }
        }

        return (
            <div className="container">
                <div className="row post-row">
                    <div className="col-2 py-3 post-row-content">{title}</div>
                    <div className="col-6 py-3 post-row-content">{content}</div>
                    <div className="col-2 py-3 post-row-content">{image &&
                    <img className="img-fluid" alt="Not found" src={`http://localhost:8083/images/posts/${image}`}/>}</div>
                    {localStorage.getItem('token') ? (
                        <div className="col-2 py-3 button-box post-row-content">
                            <Link to={`/post/${id}`} className="btn btn-primary">
                                <FaEdit /> Edit
                            </Link>
                            <Link to={`/post/deleted`} onClick={(e) => deletePost(e, id)}  className="btn btn-warning">
                                <FaTrashAlt /> Delete
                            </Link>
                        </div>
                    ) : null}
                </div>
            </div>
        );
    }
}

PostsList.propTypes = {
    post: PropTypes.shape({
        id: PropTypes.number,
        title: PropTypes.string,
        content: PropTypes.string,
        image: PropTypes.string
    }).isRequired
};

export default PostsList;