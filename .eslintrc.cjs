module.exports = {
  env: {
    node: true,
    browser: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:vue/vue3-recommended',
    'plugin:@typescript-eslint/recommended',
    'plugin:tailwindcss/recommended',
  ],
  parser: 'vue-eslint-parser',
  parserOptions: {
    parser: '@typescript-eslint/parser',
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    'array-bracket-spacing': ['warn', 'never'],
    'arrow-parens': [
      'warn',
      'as-needed',
      {
        requireForBlockBody: true,
      },
    ],
    'comma-dangle': ['warn', 'always-multiline'],
    indent: [
      'error',
      2,
      {
        SwitchCase: 1,
      },
    ],
    'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    'no-undef': 'off',
    'no-unused-vars': 'warn',
    'object-curly-spacing': ['warn', 'always'],
    quotes: [
      'warn',
      'single',
      {
        allowTemplateLiterals: true,
      },
    ],
    semi: ['warn', 'never'],
    'space-before-function-paren': [
      'error',
      {
        named: 'never',
        anonymous: 'always',
        asyncArrow: 'always',
      },
    ],
    'tailwindcss/no-custom-classname': [
      'warn',
      {
        cssFiles: ['resources/css/**/*.css'],
      },
    ],
    'vue/component-api-style': [
      'error', ['script-setup', 'composition'],
    ],
    'vue/multi-word-component-names': 'off',
    'vue/no-v-html': 'off',
    'vue/no-v-text-v-html-on-component': 'off',
    'vue/max-attributes-per-line': [
      'warn',
      {
        singleline: 1,
        multiline: 1,
      },
    ],
  },
}
