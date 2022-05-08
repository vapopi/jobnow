import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Company from './Company'
import Area from './Area'

function List() {

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
            <h1 className='text-center'><strong>OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>
                <a className="color btn btn-primary" href="/offers" role="button">List offers</a><span> </span>
                <a className="color btn btn-primary" href="/offers/create" role="button">Create offer</a><span> </span>
                <a className="color btn btn-primary" href="/offers" role="button" disabled>View applied offers</a><span> </span>
                <hr/>
                <br/>
                <h5 className='text-center'><strong>List all offers</strong></h5>
                <br/>
                <div className='row'>
                    <div style={{margin:"0 auto"}} className='col-12'>
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
                                                <td><button className="w-100 btn btn-primary">Apply</button></td>
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

export default List;

if (document.getElementById('react-listOffers')) {
    ReactDOM.render(<List />, document.getElementById('react-listOffers'));
}
