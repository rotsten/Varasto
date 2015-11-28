{% extends "base.html" %}
{% block content %}
{% import "macros/forms.html" as forms %}

<H2>Tuotetietojen listaussivu</H2>

    <form action="handle_form.php">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Varasto_id</th>
            <th>Tuote_id</th>
            <th>Tuotteen nimi</th>
            <th>Valmistaja</th>
            <th>Tuotekuvaus</th>
            <th>Lukumaar</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
           <tr>
             <td>{{varastotuote.varasto_id}}</td> 
             <td>{{varastotuote.tuote_id}}</td> 
             <td>{{varastotuote.tuotteen_nimi}}</td>  
             <td>{{varastotuote.valmistaja}}</td>
             <td>{{varastotuote.kuvaus}}</td>
             <th><a class="btn btn-default btn-sm" href="{{base_path}}/Tuote/Tuotetietojenmuutos/{{varastotuote.tuote_id}}">Muokkaa</a></th>
             <th><a class="btn btn-default btn-sm" href="{{base_path}}/Tuote/Poistatuote/{{varastotuote.tuote_id}}">Poista tuote</a></th>
          </tr>
         </tbody>    
      </table>
    </form>    

    <button class="btn btn-default"><A href="{{base_path}}/Paasivu"> Pääsivulle</A></button>

{% endblock %}

