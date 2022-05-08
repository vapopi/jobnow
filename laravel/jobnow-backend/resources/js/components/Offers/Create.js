import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';

function Create() {

    const apiOffers = '/api/offers';
    const apiCompanies = '/api/companies';
    const apiAreas = '/api/professionalarea';

    const [companies, setCompanies] = useState([]);
    const [areas, setAreas] = useState([]);
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [company, setCompany] = useState('');
    const [area, setArea] = useState(1);


    const getCompanies = async () => {
        await axios.get(apiCompanies).then(result => {
            const companiesDB = result.data;
            setCompanies(companiesDB.map((valor) => {
                return {...valor}
            }));
        });
    }

    const getAreas = async () => {
        await axios.get(apiAreas).then(result => {
            const areasDB = result.data;
            console.log(areas)
            setAreas(areasDB.map((valor) => {
                return {...valor}
            }));
        });
    }

    const postOffer = () => {
        axios.post(apiOffers, {
            title: title,
            description: description,
            company_id: company,
            professional_area_id: area
        }).then(response => { 
            console.log(response)
        })
        .catch(error => {
            console.log(error.response)
        });
    }

    useEffect(() => {
        getAreas();
        getCompanies();
    }, []);



    return (
        <div>   

            <h1 className='text-center'><strong>OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>
                <a className="color btn btn-primary" href="/offers" role="button">List offers</a><span> </span>
                <a className="color btn btn-primary" href="/offers/create" role="button">Create offer</a><span> </span>
                <a className="color btn btn-primary" href="/offers" role="button" disabled>View applied offers</a><span> </span>
                <hr/>
            </div>

            {            

                companies.length === 0 ? (
                        <li className="list-group-item" style={{textAlign: "center", color: "white", backgroundColor: "#245DD8"}}>You don't have any company.</li>
                    ) : 
                    (
                    <>

                        <br/>
                        <h5 className='text-center'><strong>Create offer</strong></h5>
                        <div className="w-75 mx-auto">
                            <div className="form-group">
                                <label>Title</label>
                                <input type="text" onChange={(event) => setTitle(event.target.value)} className="form-control" required/>
                            </div>
                            <br/>
                            <div className="form-group">
                                <label>Description</label>
                                <input type="text" onChange={(event) => setDescription(event.target.value)} className="form-control" required/>
                            </div>

                            <br/>
                            <p>Choose your company:</p>
                            <select onChange={ (event) => setCompany(event.target.value)}>
                            {
                                companies.map(key => (
                                    <option key={ key.id } value={ key.id }>{ key.name }</option>
                                ))
                            }
                            </select>

                            <br/><br/>
                            <p>Choose the professional area:</p>
                            <select onChange={ (event) => setArea(event.target.value)}>
                            {
                                areas.map(key => (
                                    <option key={ key.id } value={ key.id }>{ key.name }</option>
                                ))
                            }
                            </select>

                            <br/><br/>
                            <button type="button" onClick={() => postOffer()} className="btn btn-primary">Submit</button><span> </span>
                            <button type="reset" className="btn btn-secondary">Reset</button>
                            <br/><br/>
                        </div>
                    </>
                )
            }
        </div>
    );
}

export default Create;

if (document.getElementById('react-createOffers')) {
    ReactDOM.render(<Create />, document.getElementById('react-createOffers'));
}
