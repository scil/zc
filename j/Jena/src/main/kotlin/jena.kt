package zhenc.map

import org.apache.jena.enhanced.BuiltinPersonalities.model
import org.apache.jena.rdf.model.*
import org.apache.jena.vocabulary.*;

class JMap {

    val tutorialURI = "http://hostname/rdf/tutorial/";
    val briansName = "Brian McBride";
    val briansEmail1 = "brian_mcbride@hp.com";
    val briansEmail2 = "brian_mcbride@hpl.hp.com";
    val title = "An Introduction to RDF and the Jena API";
    val date = "23/01/2001";

    fun start(): String {

        val personURI = "http://somewhere/JohnSmith";
        val givenName = "John";
        val familyName = "Smith";
        val fullName = givenName + " " + familyName;
        // create an empty model
        val model = ModelFactory.createDefaultModel();

        // create the resource
        //   and add the properties cascading style
        val johnSmith = model.createResource(personURI)
                .addProperty(VCARD.FN, fullName)
                .addProperty(VCARD.N,
                        model.createResource()
                                .addProperty(VCARD.Given, givenName)
                                .addProperty(VCARD.Family, familyName));

        // now write the model in XML form to a file
        model.write(System.out);

        return "abc"
    }
}

