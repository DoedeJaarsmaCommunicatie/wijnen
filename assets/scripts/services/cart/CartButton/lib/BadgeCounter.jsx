import React, { Component, h } from 'preact';
import styled from 'styled-components';

const Badge = styled.small`
position: absolute;
top: 0;
left: 0;
background: white;
border-radius: 50%;
padding: .2rem;
line-height: 1;
font-size: 60%;

@media screen and (min-width: 1024px) {
	left: 80%;
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
