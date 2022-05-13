import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';

function Create({props}) {

    const apiOffers = '/api/offers';
    const apiCompanies = '/api/companies';
    const apiAreas = '/api/professionalarea';

    const [companies, setCompanies] = useState([]);
    const [areas, setAreas] = useState([]);
    const [state, setState] = useState('');
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [area, setArea] = useState(1);
    const [company, setCompany] = useState();


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

        setCompany(companies[0].id)

        axios.post(apiOffers, {
            title: title,
            description: description,
            company_id: company,
            professional_area_id: area
        }).then(response => {
            setState(response) 
        })
        .catch(error => {
            setState(error.response.data) 
            
        });
    }

    useEffect(() => {
        getAreas();
        getCompanies();
    }, []);


    return (
        <div className="text">

            <h1 className='text-center'><strong>OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>
                <a className="color btn btn-primary" href="/offers" role="button">List offers</a><span> </span>
                <a className="color btn btn-primary" href="/offers/create" role="button">Create offer</a><span> </span>
                <a className="color btn btn-primary" href="/apply" role="button" disabled>View applied offers</a><span> </span>
                <hr/>
            </div>

            {            

                companies.length === 0 ? (
                        <li className="list-group-item" style={{textAlign: "center", color: "white", backgroundColor: "#245DD8"}}>You don't have any company.</li>
                    ) : 
                    (
                    <>
                        <br/>
                        <p></p>
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
                            <select className="btn btn-secondary btn-block" onChange={ (event) => setCompany(event.target.value)}>
                            <option>Select company</option>
                            {
                                companies.map((key, index) => {
                                    if(key.author_id == props.userid)
                                    {
                                        return(
                                            <option key={ index } value={ key.id }>{ key.name }</option>
                                        )
                                    }
                                })
                            }
                            </select>

                            <br/><br/>
                            <p>Choose the professional area:</p>
                            <select className="btn btn-secondary btn-block" onChange={ (event) => setArea(event.target.value)}>
                            <option>Select area</option>
                            {
                                areas.map(key => (
                                    <option key={ key.id } value={ key.id }>{ key.name }</option>
                                ))
                            }
                            </select>

                            <br/><br/>
                            {
                                state != null ? (
                                    state.status === 200 ? (
                                        <span className="text-center text-success">{state.data}</span>
                                    ):(
                                        <span className="text-center text-danger">{state.message}</span>
                                    )
                                ):(
                                    <span className="text-center text-info"></span>
                                )
                            }
                            <br/><br/>
                            <button type="button" onClick={() => postOffer()} className="w-25 btn btn-primary">Submit</button><span> </span>
                            <button type="reset" className="w-25 btn btn-secondary">Reset</button>
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

    const element = document.getElementById('react-createOffers');
    const props = Object.assign({}, element.dataset);

    ReactDOM.render(<Create props = {props}/>, element);

}
