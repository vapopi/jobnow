import axios from 'axios';
import React, { useEffect, useState } from 'react'
import PropTypes from 'prop-types';

const Offer = ({id}) => {

    const [offer, setOffer] = useState({});

    const getOfferById = async () => {

        await axios.get('/api/offers/'+ id).then(result => {
            setOffer(result.data);

        });

    }

    useEffect(() => {
        getOfferById();

    }, []);

    return (
        <>
            { offer.title }
        </>
    )
}

Offer.propTypes = {
    id: PropTypes.number,
}

export default Offer

