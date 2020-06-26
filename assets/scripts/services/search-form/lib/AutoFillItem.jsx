import React, { Component, h } from 'preact';
import styled from 'styled-components';

const AutoFillWrapper = styled.a`
	display: block;
	margin: .5rem 0;
	
	.result-title {
		font-weight: bold;
	}
`

export class AutoFillItem extends Component {
	render() {
		const { res } = this.props
		console.dir(res);
		return (
			<AutoFillWrapper href={`/?p=${res.ID}`} key={res.ID} className={['search-autofill-result', `${res.post_type}-result`].join(' ')}>
				<h3 title={res.post_title} className="result-title">
					{ res.post_title }
				</h3>
			</AutoFillWrapper>
		)
	}
}
