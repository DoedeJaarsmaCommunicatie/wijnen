import React, { Component, h } from 'preact';
import { AutoFillItem } from './AutoFillItem'
import styled from 'styled-components';

const AutoFillWrapper = styled.div`
  position: absolute;
  top: calc(100% + .5rem + 1px);
  left: calc(-.5rem - 1px);
  right: calc(-.5rem - 1px);
  background: #ffffff;
  box-shadow: 0 4px 8px rgba(51, 51, 51, 0.345);
  z-index: 1;
  color: #000000;
  padding: 1rem;
`;

export class AutoFill extends Component {
	render() {
		if (this.props.results.length === 0) {
			return '';
		}

		return (
			<AutoFillWrapper className={'search-auto-fill'}>
				<nav>
					{this.props.results.map(res => <AutoFillItem res={res} />)}
				</nav>
			</AutoFillWrapper>
		);
	}
}
