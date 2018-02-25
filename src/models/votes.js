import axios from 'axios';

function VotesModel() {}

VotesModel.getInitVotes = () => {
    const request = axios.get(`/api.php`);
    return request;
}

export default VotesModel;