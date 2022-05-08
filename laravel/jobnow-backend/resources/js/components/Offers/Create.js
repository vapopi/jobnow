import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Company from './Company'
import Area from './Area'

function Create() {

    const url = '/api/offers';
    const [offers, setOffers] = useState([]);

    const getOffers = async () => {

        await axios.get(url).then(result => {
            const offersDB = result.data;

            setOffers(offersDB.map((valor) => {
                return {...valor, id:valor.id}

            }));
        });
    }

    useEffect(() => {
        getOffers();

    }, []);

    return (
        <>
            <div className="container mt-5">
                <h1 className='text-center'><strong>OFFERS</strong></h1>
                <a className="color btn btn-primary" href="/offers" role="button">List offers</a><span> </span>
                <a className="color btn btn-primary" href="/offers/create" role="button">Create offer</a><span> </span>
                <a className="color btn btn-primary" href="/offers" role="button" disabled>View applied offers</a><span> </span>
                <hr/>
            </div>
        </>
    );
}

export default Create;

if (document.getElementById('react-createOffers')) {
    ReactDOM.render(<Create />, document.getElementById('react-createOffers'));
}
