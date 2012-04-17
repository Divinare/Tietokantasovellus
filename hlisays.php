<?php require_once 'DB.php'; ?>
<!DOCTYPE html>

<head>
   <title>Opettajan Lisäys</title>
   <meta charset="utf-8">
</head>

   <body>
   <h1>Opettajan Lisäys</h1>

   <Form name ='henkilotiedot' Method ='Post' ACTION ='lisays.php?lisays'>

   <p>Opettajan etunimi:</p>
   <input type='text' name='etu'><p></br>

   <p>Opettajan sukunimi:</p>
   <input type='text' name='suku'></br></br>

   <p>Opettajan sähköposti:</p>
    <input type='text' name='sposti'></br></br>

   <p>Opettajan salasana:</p>
   <input type'text' name='passu'></br></br>

   <p>Rooli:<p>
   <input type="radio" name="rooli" value="opettaja" checked> Opettaja </br>
   <input type="radio" name="rooli" value="admin"> Admin </br>
   <input type="radio" name="rooli" value="vastuuhenkilö"> Laitoksen Vastuuhenkilö </br>

   <Input type = 'Submit' Name = 'submit' Value = 'Lähetä'>

    <p> <a href=admin.php?admin=<?php print $_GET['hlisays']; ?>>Takaisin</a></p>

   </form>
   <body>
