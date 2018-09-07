//Various SPARQL queries - testing the ontology

PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX owl: <http://www.w3.org/2002/07/owl#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
PREFIX : <http://www.semanticweb.org/user/ontologies/2018/8/untitled-ontology-5#>

SELECT ?x WHERE {?x :genre_liked_by :Korbakis.}

SELECT ?nn ?mm WHERE {?nn :is_of_genre :heavy_metal.}

SELECT ?x ?y WHERE {?x  :likes_genre ?y.}

SELECT ?x WHERE {?x rdfs:subClassOf :Genre.}

SELECT ?x WHERE {?x  rdf:type :User.}