// import 'bootstrap/dist/css/bootstrap.css';
import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';



const Offers = () => {

  const [offers, setOffers] = useState([]);
  const url = 'http://127.0.0.1:8000/api/offers'

  const getOffers = async () => {

    await axios.get(url).then(result => {
        setOffers(result.data);

    });
  }

  useEffect(() => {

    getOffers();

  }, []);



  return (
    <>
      {
        offers.map((v) => {
          <>
            <p>aa</p>
            <p>{v.id}</p>
          </>
        })
      
      }
    </>
    
  )
}

export default Offers;

if (document.getElementById('offers')) {
    ReactDOM.render(<Offers />, document.getElementById('offers'));
}