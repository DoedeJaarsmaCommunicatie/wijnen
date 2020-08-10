import React, { Component, createRef, h } from 'preact';
import styled from 'styled-components';
import PropTypes from 'prop-types';

const AutoFillWrapper = styled.a`
	display: block;
	margin: .5rem 0;
	padding: 1rem;
	pointer-events: all;
	
	.result-title {
		font-weight: bold;
	}
	
	&:hover, &:focus {
		background: #1c413f;
		color: #ffffff;
	}
`

export class AutoFillItem extends Component {
	self = createRef();

	render() {
		const { res } = this.props;

		return (
			<AutoFillWrapper href={`/?p=${res.ID}`}
							 key={res.ID} ref={this.self}
							 className={['search-autofill-result', `${res.post_type}-result`].join(' ')} >
				<h3 title={res.post_title} className="result-title">
					{ res.post_title }
				</h3>
			</AutoFillWrapper>
		)
	}
}

AutoFillItem.propTypes = {
	res: PropTypes.shape({
		ID: PropTypes.number.isRequired,
		post_type: PropTypes.string.isRequired,
	}),
	focused: PropTypes.bool,
}
