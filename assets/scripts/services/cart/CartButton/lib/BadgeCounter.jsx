import React, { Component } from 'preact';
import styled from 'styled-components';

const Badge = styled.small`
position: absolute;
top: 0;
left: 0;
background: white;
border-radius: 50%;
padding: 0.1rem .3rem;
line-height: 1;
font-size: 60%;
color: currentColor;

@media screen and (min-width: 1024px) {
	left: 80%;
	color: #000;
}
`;

export class BadgeCounter extends Component {
	render() {
		return (
			<Badge>
				{ this.props.count }
			</Badge>
		)
	}
}
