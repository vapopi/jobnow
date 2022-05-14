import axios from 'axios';
import React, { useEffect, useState } from 'react'
import PropTypes from 'prop-types';

const Company = ({id}) => {

    const [company, setCompany] = useState({});

    const getCompanyById = async () => {

        await axios.get('/api/companies/'+id).then(result => {

            setCompany(result.data);
        });

    }

    useEffect(() => {
        getCompanyById();
    }, []);

    return (
        <>
            { company.name }
        </>
    )
}

Company.propTypes = {
    id: PropTypes.int,
}

export default Company