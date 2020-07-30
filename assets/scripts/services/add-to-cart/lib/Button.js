import styled, { css } from 'styled-components';
import { darken } from 'polished';

export const primary = '#c96464';
export const secondary = '#9fd6d3';
export const white = '#ffffff';
export const blue = '#05597c';

export const StyledButton = styled.button`
padding: .5rem;
border-radius: .25rem;
width: 100%;
border: 1px solid ${props => props.secondary? secondary : primary};
transition: all 225ms ease;

${props => props.outline? css`
background: transparent;
color: ${props => props.secondary? secondary : primary};

&:hover {
	background: ${props.secondary? secondary : primary};
	color: ${props => props.secondary? blue : white};
}
` : css`
background: ${props => props.secondary? secondary : primary };
color: ${props => props.secondary? blue : white};

&:hover {
	background: ${darken(.2, props.secondary? secondary : primary)};
}
`}
`;
