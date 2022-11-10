let darkMode = localStorage.getItem('darkMode');
const darkModeToggle = document.querySelector('#dark-button');

const enableDarkMode = () =>{
    document.body.classList.add('darkmode');
    localStorage.setItem('darkMode', 'enabled');
};

const disableDarkMode = () =>{
    document.body.classList.remove('darkmode');
    localStorage.removeItem('darkMode');
};

 if(darkMode === 'enabled'){
    enableDarkMode();
}

darkModeToggle.addEventListener('click', () => {
    darkMode = localStorage.getItem('darkMode');
   
    if(darkMode !== 'enabled'){
        enableDarkMode();
    }else{
        disableDarkMode();
    }
});