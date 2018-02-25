import React, { Component } from 'react';
import axios from 'axios';
import Fruit from './components/Fruit';
// import VotesModel from './models/votes';
import './App.css';

export default class App extends Component {
  constructor(){
    super();
    this.state = {
      fruits: []
    }
  }
  updateVote = (id) => {
    console.log(id);
    const fruits = this.state.fruits;
    fruits[id].votes += 1;
    // this.setState({
    //   fruits: fruits
    // })
    axios.post(`http://localhost/api.php?fruit=${id}&?votes=${fruits[id].votes}`).then((res) => {
      this.getData();
    });
  }
  renderFruits = (key) => {
      return <Fruit key={key} id={key} name={this.state.fruits[key].name} votes={this.state.fruits[key].votes} updateVote={this.updateVote} />
  }
  componentDidMount() {
    this.getData();
  }
  getData() {    
    axios.get('http://localhost/api.php').then((res)=> {
      console.log(res.data);
      this.setState({
        fruits: res.data
      })
    })
  }

  render() {
    return (
      <div className="App">
        <h1> Welcome ! </h1>
        <div className="votes-container">
        {Object.keys(this.state.fruits).map(this.renderFruits)}
        </div>
      </div>
    );
  }
}
