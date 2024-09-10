/* FUNCIONAMENTO CORRETO DO BOTÃO --------------------------------- */

document.addEventListener('DOMContentLoaded', (event) => {

    /* CARD 1 */
    const card1 = document.getElementById('card1');
    const dropdown1 = document.getElementById('dropdown1');

    dropdown1.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card1.focus(); // Mantém o foco no botão
    });

    /* CARD 2 */
    const card2 = document.getElementById('card2');
    const dropdown2 = document.getElementById('dropdown2');

    dropdown2.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card2.focus(); // Mantém o foco no botão
    });

    /* CARD 3 */
    const card3 = document.getElementById('card3');
    const dropdown3 = document.getElementById('dropdown3');

    dropdown3.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card3.focus(); // Mantém o foco no botão
    });

    /* CARD 4 */
    const card4 = document.getElementById('card4');
    const dropdown4 = document.getElementById('dropdown4');

    dropdown4.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card4.focus(); // Mantém o foco no botão
    });

    /* CARD 5 */
    const card5 = document.getElementById('card5');
    const dropdown5 = document.getElementById('dropdown5');

    dropdown5.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card5.focus(); // Mantém o foco no botão
    });

    
    /* CARD 6 */
    const card6 = document.getElementById('card6');
    const dropdown6 = document.getElementById('dropdown6');

    dropdown6.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card6.focus(); // Mantém o foco no botão
    });

    
    /* CARD 7 */
    const card7 = document.getElementById('card7');
    const dropdown7 = document.getElementById('dropdown7');

    dropdown7.addEventListener('mousedown', (event) => {
        event.preventDefault();
        card7.focus(); // Mantém o foco no botão
    });

});