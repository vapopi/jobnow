import axios from 'axios';
import React, { useEffect, useState } from 'react'

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

export default Offer