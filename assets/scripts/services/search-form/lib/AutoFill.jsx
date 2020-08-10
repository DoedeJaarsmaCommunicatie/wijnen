import React, { Component, h } from 'preact';
import { AutoFillItem } from './AutoFillItem'
import PropTypes from 'prop-types';
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
`;

export class AutoFill extends Component {
	render() {
		const { results, keyDownEvent } = this.props;

		if (results.length === 0) {
			return '';
		}

		return (
			<AutoFillWrapper className={'search-auto-fill'}>
				<nav>
					{results.map((res, index) => (
						<AutoFillItem
							res={res}
							keyDownEvent={keyDownEvent} />
					))}
				</nav>
			</AutoFillWrapper>
		);
	}
}

AutoFill.propTypes = {
	results: PropTypes.array,
	cursor: PropTypes.number,
	keyDownEvent: PropTypes.func,
}
