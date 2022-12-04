
var subject = "radiation";

var url = 'https://en.wikipedia.org/w/api.php';
params = {
    'action': 'query',
    'format': 'json',
    'titles': subject,
    'prop': 'extracts',
    'exintro': "True"
};

import axios from 'axios';
const res = axios.get(url, {
    params: {
        'action': 'query',
        'format': 'json',
        'titles': subject,
        'prop': 'extracts',
        'exintro': True
    }
}).then(function (response) {
    console.log(response.data);
})
    .catch(function (error) {
        console.error(error);
    });