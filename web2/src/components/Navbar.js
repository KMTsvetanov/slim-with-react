import React, {Component} from 'react';
import { Link } from 'react-router-dom';
import logo from '../logo.png';
import { FaRegComment, FaUserPlus, FaUser } from 'react-icons/fa';

class Navbar extends Component {
    render() {
        return (
            <div className="navbar navbar-expand-sm navbar-dark px-sm-5 nav-bar-color">
                <Link to="/" className="nav-link">
                    <img src={logo} alt="NavBar Logo" className="navbar-brand" />
                </Link>
                <ul className="navbar-nav align-items-center">
                    <li className="nav-item ml-5">
                        <Link to="/post" className="nav-link">
                            <FaRegComment /> Posts
                        </Link>
                    </li>
                    <li className="nav-item ml-5">
                        <Link to="/post/create" className="nav-link">
                            <FaRegComment /> Create Post
                        </Link>
                    </li>
                </ul>
                <ul className="navbar-nav align-items-center ms-auto">
                    <li className="nav-item ml-5">
                        <Link to="/auth/register" className="nav-link">
                            <FaUserPlus /> Register
                        </Link>
                    </li>
                    <li className="nav-item ml-5">
                        <Link to="/auth/login" className="nav-link">
                            <FaUser /> Login
                        </Link>
                    </li>
                </ul>
            </div>
        );
    }
}

export default Navbar;