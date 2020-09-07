module.exports = {
  purge: false,
  important: true,
  theme: {
    extend: {
      colors: {
        primary: {
          default: 'hsl(33,26%,52%)',
        },
        secondary: {
          default: 'hsl(46,52%,94%)',
        },
        tertiary: {
          default: 'hsl(20,25%,79%)'
        },
        black: {
          default: 'hsl(0,0%,0%)',
        },
        white: {
          default: 'hsl(0,0%,100%)',
        },
        grey: {
          default: 'hsl(0,0%,58%)'
        }
      }
    },
  },
  future: {
    removeDeprecatedGapUtilities: true,
  },
  variants: {},
  plugins: [],
};
