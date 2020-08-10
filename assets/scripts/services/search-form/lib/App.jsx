import React, { Component, h, createRef } from 'preact';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch, faSpinner } from '@fortawesome/free-solid-svg-icons';
import { AutoFill } from './AutoFill';
import styled from 'styled-components';

const SearchApp = styled.div`
  display: flex;
  width: 100%;
  position: relative;
  background: transparent;
  
  input {
  	background: transparent;
  	color: #1c413f;
  	&::placeholder {
  		opacity: 0.8;
  	}
  }
`;

export class App extends Component {
	form = createRef();

	constructor() {
		super();

		this.abortControllers = [];

		this.state = {
			loading: false,
			show_results: false,
			results: [],
			cursor: 0
		};

		this.handleFocusEvent = this.handleFocusEvent.bind(this);
		this.hideSearchFill = this.hideSearchFill.bind(this);
		this.handleSearchInput = this.handleSearchInput.bind(this);
	}

	handleFocusEvent(e) {
		this.setState({
			show_results: true,
		});
	}

	hideSearchFill(e) {
		if (!this.form.current) {
			return;
		}

		if (this.form.current.contains(e.target)) {
			return;
		}

		this.setState({
			show_results: false,
		});
	}

	async handleSearchInput(e) {
		this.setState({ loading: true });
		this.abortControllers.forEach(abortController => abortController.abort());
		const abortController = new AbortController(),
			value = e.target.value;
		this.abortControllers.push(abortController);
		if ('' === value || null === value || !value) {
			return this.hideSearchFill();
		}

		let res;

		try {
			res = await (await fetch(window['ajax_url'] + `?action=search_results&s=${value}`, {
				signal: abortController.signal,
			})).json();
		} catch { return; } // Signal aborted.

		this.setState({
			show_results: true,
			results: res.data.posts,
			loading: false
		});
	}

	render() {
		const { show_results, results, loading, cursor } = this.state;
		return (
			<SearchApp className={'search-app'}>
				<input
					placeholder={'Zoek een product...'}
					id={'s'}
					name={'s'}
					type={'search'}
					autoComplete={'off'}
					className={'search-form-input'}
					onFocus={this.handleFocusEvent}
					onBlur={this.hideSearchFill}
					onInput={this.handleSearchInput} />

				<button type={'submit'} className={'search-button'}>
					<FontAwesomeIcon icon={loading? faSpinner : faSearch} spin={loading} />
				</button>

				{show_results && <AutoFill results={results}
										   keyDownEvent={this.keyDownEvent}
										   cursor={cursor}
										   className={'search-auto-fill'} />}
			</SearchApp>
		);
	}
}
