import React, { useEffect, useState, useContext } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css';
import Company from './Company'
import Area from './Area'
import PropTypes from 'prop-types';

function Offers({props}) {

    const apiOffers = '/api/offers';
    const apiApplicatedOffers = '/api/applicatedoffers';

    const [offers, setOffers] = useState([]);
    const [offer, setOffer] = useState({});
    const [curriculum, setCurriculum] = useState([]);
    const [filter, setFilter] = useState([])
    const [offerFind, setOfferFind] = useState("")
    const [state, setState] = useState({});


    const getOffers = async () => {
        await axios.get(apiOffers).then(result => {
            const offersDB = result.data;

            setOffers(offersDB.map((valor) => {
                return {...valor, id:valor.id}

            }));
        });
    }

    useEffect(() => {
        getOffers();
    }, []);


    useEffect( () => {
        setFilter(offers)
    }, [offers])


    const postApply = () => {

        var formData = new FormData();
        formData.append("curriculum", curriculum);
        formData.append("offer_id", offer.offer_id);
        formData.append("user_id", props.userid);

        axios({
            method: 'post',
            url: apiApplicatedOffers,
            data: formData,
            header: {
                    'Content-Type': 'multipart/form-data',
                    },
        }).then(response => {
            window.location.reload();
            setState(response) 

        })
        .catch(error => {
            setState(error.response.data) 
        });
    }


    function filterOffer(ofr){
        return function(x){
          return x.description.toLowerCase().includes(ofr) || !ofr
        }
    }

    const handleInputChange = ({target}) => {

        setOffer({
            ...offer,
            [target.name]:target.value

        })
    }

    return (
        <div className="w-100 ">
            <h1 className='text-center'><strong>OFFERS</strong></h1>
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
                <div className="float-start w-50 listOffers">
                    <h5 className='text-center'><strong>List all offers</strong></h5>
                    <br/>
                    <div className='row'>
                        <input 
                        className="form-control mb-2" 
                        name="offerFind" 
                        onChange={e => setOfferFind(e.target.value)} 
                        type="text" 
                        placeholder="🔎︎ Search offers"
                        style={{backgroundColor: "#E6E6E6"}}/>

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
                                        filter.filter(filterOffer(offerFind)).map((element) => {
                                            return (
                                                <tr key={element.id}>
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
                                        <select 
                                            name="offer_id" 
                                            onChange={handleInputChange} 
                                            className="w-50 btn btn-secondary dropdown-toggle" 
                                            key="usuaris">

                                        <option>Select ID</option>
                                        {
                                            offers.map((element, index) => {
                                                return(
                                                    <option
                                                        key={ element.id } 
                                                        value={ element.id }>{ element.id }
                                                    </option>
                                                )
                                            })
                                        }
                                        </select>
                                    </div>
                                    <br/>
                                    <p>Attach your curriculum vitae</p>
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
                                    <span className="text-warning"></span>
                                    <input 
                                        name="curriculum" 
                                        type="file" 
                                        onChange={(data) => setCurriculum(data.target.files[0])}
                                        className="form-control mb-2"/>

                                    <button 
                                        onClick={() => postApply()} 
                                        className="btn btn-primary btn-block" 
                                        type="button" 
                                        style={{ width: "100%"}}>Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

Offers.propTypes = {
    props: PropTypes.object,
}

export default Offers;

if (document.getElementById('react-listOffers')) {
    const element = document.getElementById('react-listOffers');
    const props = Object.assign({}, element.dataset);

    ReactDOM.render(<Offers props = {props}/>, element);
}