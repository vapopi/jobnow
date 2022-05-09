import React, { useEffect, useState, useContext } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';

function Apply() {

    return (
        <p>{offer}</p>
    );
}

export default Apply;

if (document.getElementById('react-applyOffer')) {
    ReactDOM.render(<Apply />, document.getElementById('react-applyOffer'));
}
