import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Company from './Company'
import Area from './Area'

function Offers() {

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
                <a className="color btn btn-primary" href="/offers" role="button">View applied offers</a><span> </span>
                <hr/>
                <div className='row'>
                    <div style={{margin:"0 auto"}} className='col-12'>
                        <h4 className='text-center'>List all offers</h4>
                        {
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Company</th>
                                        <th>Professional Area</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>

                                <tbody>
                                {
                                    offers.map((element, index) => {
                                        return (
                                            <tr key={index}>
                                                <td>{element.title}</td>
                                                <td>{element.description}</td>
                                                <td><Company id={element.company_id}/></td>
                                                <td><Area id={element.professional_area_id}/></td>
                                                <td><button className="w-100 btn btn-primary" onClick={() => deleteMessage(element.id)}>Apply</button></td>
                                            </tr>
                                        )
                                    })      
                                }
                                </tbody>
                            </table>
                        }
                    </div>
                </div>
            </div>
        </>
    );
}

export default Offers;

if (document.getElementById('react-listOffers')) {
    ReactDOM.render(<Offers />, document.getElementById('react-listOffers'));
}
