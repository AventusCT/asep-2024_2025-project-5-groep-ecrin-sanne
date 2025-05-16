// Functie om vragen op te halen van de Open Trivia Database
async function haalVragenOp() {
    try {
      const response = await fetch('https://opentdb.com/api.php?amount=10&category=9&type=multiple');
      const data = await response.json();
      return data.results.map(vraag => {
        return {
          vraag: vertaalVraag(vraag.question), // Vertaal de vraag naar Nederlands
          opties: [...vraag.incorrect_answers, vraag.correct_answer].map(optie => vertaalOptie(optie)), // Vertaal opties
          juist: vertaalOptie(vraag.correct_answer) // Vertaal het juiste antwoord
        };
      });
    } catch (error) {
      console.error("Fout bij het ophalen van vragen:", error);
      return [];
    }
  }
  
  // Vertaal de vraag naar het Nederlands
  function vertaalVraag(vraagEngels) {
    const vertalingen = {
      'What is the capital of France?': 'Wat is de hoofdstad van Frankrijk?',
      'What is 2 + 2?': 'Wat is 2 + 2?',
      'Who wrote the book "1984"?': 'Wie schreef het boek "1984"?',
      // Voeg hier meer vertaalde vragen toe
    };
    return vertalingen[vraagEngels] || vraagEngels; // Als er geen vertaling is, laat de Engelse vraag staan
  }
  
  // Vertaal de optie naar het Nederlands
  function vertaalOptie(optieEngels) {
    const vertalingen = {
      'Paris': 'Parijs',
      'London': 'Londen',
      'George Orwell': 'George Orwell',
      '4': '4',
      '3': '3',
      // Voeg hier meer vertaalde opties toe
    };
    return vertalingen[optieEngels] || optieEngels; // Als er geen vertaling is, laat de Engelse optie staan
  }
  