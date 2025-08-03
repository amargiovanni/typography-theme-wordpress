/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './templates/**/*.php',
    './parts/**/*.php',
    './js/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        'serif': ['Crimson Text', 'Georgia', 'serif'],
        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
      fontSize: {
        '7xl': '5rem',
        '8xl': '6rem',
        '9xl': '7rem',
      },
      lineHeight: {
        'tighter': '1.1',
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            maxWidth: 'none',
            color: theme('colors.gray.800'),
            lineHeight: '1.75',
            fontSize: '1.125rem',
            a: {
              color: theme('colors.gray.900'),
              textDecoration: 'none',
              borderBottom: '1px solid',
              borderColor: theme('colors.gray.300'),
              '&:hover': {
                color: theme('colors.gray.600'),
                borderColor: theme('colors.gray.600'),
              },
            },
            'h1, h2, h3, h4, h5, h6': {
              fontFamily: theme('fontFamily.serif').join(', '),
              fontWeight: '600',
              lineHeight: '1.2',
            },
            h1: {
              fontSize: '3rem',
              marginTop: '0',
              marginBottom: '2rem',
            },
            h2: {
              fontSize: '2.25rem',
              marginTop: '3rem',
              marginBottom: '1.5rem',
            },
            h3: {
              fontSize: '1.875rem',
              marginTop: '2.5rem',
              marginBottom: '1rem',
            },
            p: {
              marginTop: '1.5rem',
              marginBottom: '1.5rem',
            },
            blockquote: {
              fontStyle: 'italic',
              borderLeftColor: theme('colors.gray.300'),
              borderLeftWidth: '4px',
              paddingLeft: '1.5rem',
              marginLeft: '0',
              marginRight: '0',
              quotes: 'none',
            },
            code: {
              backgroundColor: theme('colors.gray.100'),
              padding: '0.25rem 0.5rem',
              borderRadius: '0.25rem',
              fontSize: '0.875em',
            },
            'code::before': {
              content: '""',
            },
            'code::after': {
              content: '""',
            },
            pre: {
              backgroundColor: theme('colors.gray.900'),
              color: theme('colors.gray.100'),
              padding: '1.5rem',
              borderRadius: '0.5rem',
              overflowX: 'auto',
            },
            img: {
              borderRadius: '0.5rem',
              marginTop: '2rem',
              marginBottom: '2rem',
            },
            hr: {
              borderColor: theme('colors.gray.200'),
              marginTop: '3rem',
              marginBottom: '3rem',
            },
          },
        },
        lg: {
          css: {
            fontSize: '1.25rem',
            lineHeight: '1.8',
            p: {
              marginTop: '1.75rem',
              marginBottom: '1.75rem',
            },
            h1: {
              fontSize: '3.5rem',
            },
            h2: {
              fontSize: '2.5rem',
            },
            h3: {
              fontSize: '2rem',
            },
          },
        },
        xl: {
          css: {
            fontSize: '1.5rem',
            lineHeight: '1.8',
            p: {
              marginTop: '2rem',
              marginBottom: '2rem',
            },
            h1: {
              fontSize: '4rem',
            },
            h2: {
              fontSize: '3rem',
            },
            h3: {
              fontSize: '2.25rem',
            },
          },
        },
        '2xl': {
          css: {
            fontSize: '1.75rem',
            lineHeight: '1.8',
            p: {
              marginTop: '2.25rem',
              marginBottom: '2.25rem',
            },
            h1: {
              fontSize: '4.5rem',
            },
            h2: {
              fontSize: '3.5rem',
            },
            h3: {
              fontSize: '2.5rem',
            },
          },
        },
      }),
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}