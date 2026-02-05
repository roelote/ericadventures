/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./template-parts/**/*.php",
    "./*.php",
    "./js/*.js"
  ],
  theme: {
    fontFamily: {
      'nunito': ['Nunito'],
      //'mont': ['Montserrat'],
    },
    
    container: {
      center: true,
      
    },

    extend: {
      colors: {
        'eric': '#aa2525',
        'eric2':'#FF6',
        'eric-moto':'#AA0404',
      },
      
      maxHeight: {
       
        116: "29rem",
        /*464px*/
        125: "31.25rem",
        /*500px*/
        140: "35rem",
        /*560px*/
        150: "37.5rem",
        /*600px*/
        190: "47.5rem",
        /*760px*/
      },
      height: {
        123:"12.3rem",
        102: "25rem",
        116: "29rem",
        /*464px*/
        125: "31.25rem",
        /*500px*/
        140: "35rem",
        /*560px*/
        150: "37.5rem",
        /*600px*/
        190: "47.5rem",
        /*760px*/
      },
    },
  },
  plugins: [

    
  ],
}

