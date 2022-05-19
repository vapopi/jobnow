import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import PropTypes from 'prop-types';

function Create({props}) {

    const apiOffers = '/api/offers';
    const apiCompanies = '/api/companies';
    const apiAreas = '/api/professionalarea';

    const [companies, setCompanies] = useState([]);
    const [areas, setAreas] = useState([]);
    const [offer, setOffer] = useState({});
    const [state, setState] = useState();


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

            setAreas(areasDB.map((valor) => {
                return {...valor}
            }));
        });
    }

    const postOffer = () => {

        if(offer.title == null || offer.description == null || offer.company_id == "Select option" || offer.professional_area_id == "Select option" || offer.company_id == null || offer.professional_area_id == null) {
            return alert("Please fill all the fields")
        }

        axios.post(apiOffers, {
            title: offer.title.toLowerCase(),
            description: offer.description.toLowerCase(),
            company_id: offer.company_id,
            professional_area_id: offer.professional_area_id
            
        }).then(response => {
            setState(response) 

        }).catch(error => {
            setState(error.response.data) 
            
        });
    }

    useEffect(() => {
        getAreas();
        getCompanies();
    }, []);

    const handleInputChange = ({target}) => {

        setOffer({
            ...offer,
            [target.name]:target.value
        })
    }

    return (
        <div className="all text">

            <h1 className='text-center'><strong>OFFERS</strong></h1>
            <div className="container mt-5" style={{textAlign: 'center'}}>
                <a 
                    className="offersMenu color btn btn-primary" 
                    href="/offers" 
                    role="button">List offers
                </a><span> </span>

                <a 
                    className="offersMenu color btn btn-primary" 
                    href="/offers/create" 
                    role="button">Create offer
                </a><span> </span>

                <a 
                    className="offersMenu color btn btn-primary" 
                    href="/apply" 
                    role="button">View applied offers
                </a><span> </span>
                
                <hr/>
            </div>

            {            

                companies.length === 0 ? (
                        <li 
                            className="list-group-item" 
                            style={{textAlign: "center", color: "white", backgroundColor: "#8c82ec"}}
                            >You don't have any company.
                        </li>
                    ) : 
                    (
                    <div className="formContainer shadow mx-auto w-75">
                        <br/>
                        <p></p>
                        <div className="formCreate">
                            <h4 className='text-center'><strong>Create Offer</strong></h4>

                            <div className="w-75 mx-auto">
                                <div className="form-group">
                                    <label>Title:</label>
                                    <input 
                                        type="text" 
                                        name="title"
                                        onChange={handleInputChange} 
                                        placeholder="Write the title..."
                                        className="form-control" 
                                        required/>
                                </div>

                                <br/>
                                <div className="form-group">
                                    <label>Description:</label>
                                    <input 
                                        type="text" 
                                        name="description"
                                        onChange={handleInputChange} 
                                        className="form-control" 
                                        placeholder="Write the description..."
                                        required/>
                                </div>

                                <br/>
                                <p>Choose your company:</p>
                                <select 
                                    name="company_id"
                                    className="selectId w-50 btn btn-secondary btn-block" 
                                    onChange={handleInputChange}>
                                    <option>Select option</option>    
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
                                <select 
                                    name="professional_area_id"
                                    className="selectId w-50 btn btn-secondary btn-block" 
                                    onChange={handleInputChange}>
                                    <option>Select option</option>    
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

                                <button 
                                    type="button" 
                                    onClick={() => postOffer()} 
                                    className="mb-3 w-25 btn btn-primary">Send
                                </button><span> </span>

                                <button 
                                    type="reset" 
                                    className="reset mb-3 w-25 btn btn-dark">Reset
                                </button>
                                <br/><br/>
                            </div>
                        </div>
                    </div>
                )
            }
        </div>
    );
}

Create.propTypes = {
    props: PropTypes.object,
}

export default Create;

if (document.getElementById('react-createOffers')) {

    const element = document.getElementById('react-createOffers');
    const props = Object.assign({}, element.dataset);

    ReactDOM.render(<Create props = {props}/>, element);

}
