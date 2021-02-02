import React from 'react';

export default function InputField({ name, type, value, error, placeholder, onChange, label }) {
    return (
        <div className="form-group">
            <label className="h2" htmlFor={name}>{label}</label>
            <input type={type}
                   name={name}
                   id={name}
                   value={value}
                   className={`form-control ${error ? "is_invalid" : ""}`}
                   placeholder={placeholder}
                   onChange={onChange}
            />
            {error ? (
                <div className="h2 invalid-feedback-error">{error[Object.keys(error)[0]]}</div>
            ) : null}
        </div>
    );
}