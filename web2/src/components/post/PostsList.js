import React, {Component} from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import { FaEdit, FaTrashAlt } from 'react-icons/fa';
import axios from "axios";

class PostsList extends Component {

    render() {
        const { id, title, content, image } = this.props.post;

        function deletePost(id) {
            axios.delete(`/post/${id}`).then(res => {})
        }

        return (
            <div className="container post-row-content">
                <div className="row post-row">
                    <div className="col-2 py-3">{title}</div>
                    <div className="col-6 py-3">{content}</div>
                    <div className="col-2 py-3">{image &&
                    <img className="img-fluid" alt="Not found" src={`http://localhost:8083/images/posts/${image}`}/>}</div>
                    <div className="col-2 py-3 button-box">
                        <Link to={`/post/${id}`} className="btn btn-primary">
                            <FaEdit /> Edit
                        </Link>
                        <Link to={`/post/deleted`} onClick={() => deletePost(id)}  className="btn btn-warning">
                            <FaEdit /> Delete
                        </Link>
                    </div>
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