import React, {Component} from 'react';

export default class Fruit extends Component {
    render() {
        return (
            <div className="fruit">
            <h1>{this.props.name}</h1>
            <p> {this.props.votes}</p>
            <div onClick={() => {this.props.updateVote(this.props.id)}}>Vote!</div>
            </div>
        )
    }
};
