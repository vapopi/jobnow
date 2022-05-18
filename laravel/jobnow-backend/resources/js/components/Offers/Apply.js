import React, { useEffect, useState, useContext } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Offer from './Offer'
import PropTypes from 'prop-types';


function Apply({props}) {

    const apiApplicatedOffers = '/api/applicatedoffers';

    const [offers, setOffers] = useState([]);

    const getOffers = async () => {
        await axios.get(apiApplicatedOffers).then(result => {
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
        <div className="w-100 ">
            <h1 className='text-center'><strong>YOUR APPLICATED OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>

                <a 
                    className="color btn btn-primary" 
                    href="/offers" 
                    role="button">List offers
                </a><span> </span>

                <a 
                    className="color btn btn-primary" 
                    href="/offers/create" 
                    role="button">Create offer
                </a><span> </span>

                <a 
                    className="color btn btn-primary" 
                    href="/apply" 
                    role="button">View applied offers
                </a><span> </span>

                <hr/>
                <br/>
                <div className="listOffers">

                    <h5 className='text-center'><strong>List all applicated offers</strong></h5>
                    <br/>
                    <div className='row'>
                        <div style={{margin:"0 auto"}} className='col-12'>
                            {
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Offer</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {
                                        offers.map((element, index) => {

                                            if(element.user_id == props.userid) {

                                                return (
                                                <tr key={index}>
                                                    <td>{element.offer_id}</td>
                                                    <td><Offer id={element.offer_id}/></td>
                                                </tr>
                                                )

                                            }
                                        })      
                                    }
                                    </tbody>
                                </table>
                            }
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

Apply.propTypes = {
    props: PropTypes.object,
}

export default Apply;

if (document.getElementById('react-applyOffer')) {
    const element = document.getElementById('react-applyOffer');
    const props = Object.assign({}, element.dataset);

    ReactDOM.render(<Apply props = {props}/>, element);
}