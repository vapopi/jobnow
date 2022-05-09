import React, { useEffect, useState, useContext } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Company from './Company'
import Area from './Area'

function List() {

    const url = '/api/offers';
    const apiApplicatedOffers = '/api/applicatedoffers';
    const apiFiles = '/api/files';

    const [offers, setOffers] = useState([]);

    const [offer, setOffer] = useState('');
    const [curriculum, setCurriculum] = useState();
    const [user, setUser] = useState('');

    const d = new Date();

    const getOffers = async () => {
        await axios.get(url).then(result => {
            const offersDB = result.data;

            setOffers(offersDB.map((valor) => {
                return {...valor, id:valor.id}

            }));
        });
    }
    
    const postApply = () => {
        axios.post(apiFiles, {
            filename: "uploads/"+d.getMilliseconds()+"_"+curriculum[0].name,
            filesize: curriculum[0].size,
        }).then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        });

        axios.post(apiApplicatedOffers, {
            user_id: 1,
            curriculum: 1,
            offer_id: offer,
        }).then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        });
    }
    useEffect(() => {
        getOffers();
    }, []);

    return (
        <div className="w-100 ">
            <h1 className='text-center'><strong>OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>

                <a className="color btn btn-primary" href="/offers" role="button">List offers</a><span> </span>
                <a className="color btn btn-primary" href="/offers/create" role="button">Create offer</a><span> </span>
                <a className="color btn btn-primary" href="/offers" role="button" disabled>View applied offers</a><span> </span>
                <hr/>
                <br/>
                <div className="float-start w-50 listOffers">

                    <h5 className='text-center'><strong>List all offers</strong></h5>
                    <br/>
                    <div className='row'>
                        <div style={{margin:"0 auto"}} className='col-12'>
                            {
                                <table className="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Company</th>
                                            <th>Professional Area</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {
                                        offers.map((element, index) => {
                                            return (
                                                <tr key={index}>
                                                    <td>{element.id}</td>
                                                    <td>{element.title}</td>
                                                    <td>{element.description}</td>
                                                    <td><Company id={element.company_id}/></td>
                                                    <td><Area id={element.professional_area_id}/></td>
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
            </div>

            <div className="float-start listOffers w-50 formApply">

                <div className="container" style={{textAlign: 'center'}}>
                    <div className="float-start w-75 listOffers">
                        <h5 className='text-center'><strong>Apply to offer</strong></h5>
                        <div className='row'>
                            <div style={{margin:"0 auto"}} className='col-12'>
                                <form>
                                    <div>
                                        <p>Choose the id of the offer:</p>
                                        <select name="offer_id" onChange={(data) => setOffer(data.target.value)} className="w-50 btn btn-secondary dropdown-toggle" key="usuaris">
                                        {
                                            offers.map((element, index) => {
                                                return(
                                                    <option key={ element.id } value={ element.id }>{ element.id }</option>
                                                )
                                            })
                                        }
                                        </select>
                                    </div>
                                    <br/>
                                    <p>Attach your curriculum vitae</p>
                                    <span className="text-warning"></span>
                                    <input name="message" type="file" onChange={(data) => setCurriculum(data.target.files)} className="form-control mb-2"/>
                                    <button onClick={() => postApply()} className="btn btn-primary btn-block" type="button" style={{ width: "100%"}}>Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default List;

if (document.getElementById('react-listOffers')) {
    ReactDOM.render(<List />, document.getElementById('react-listOffers'));
}