import axios from 'axios';
import React, { useEffect, useState } from 'react'
import PropTypes from 'prop-types';


const Area = ({id}) => {

    const [area, setArea] = useState({});

    const getArea = async () => {

        await axios.get('/api/professionalarea/'+id).then(result => {

            setArea(result.data);
        });

    }

    useEffect(() => {
        getArea();
    }, []);

    return (
        <>
            { area.name }
        </>
    )
}

Area.propTypes = {
    id: PropTypes.number,
}

export default Area