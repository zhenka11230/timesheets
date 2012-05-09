import com.itextpdf.text.pdf.PdfReader;
import com.itextpdf.text.pdf.FdfReader;
import com.itextpdf.text.pdf.PdfStamper;
import com.itextpdf.text.pdf.AcroFields;


import java.io.*;

public class StreamPdf {
    public static void main(String args[]) {

        if (args.length == 3 || args.length == 4) {

            try {

                // the input PDF
                PdfReader reader = new PdfReader(args[0]);

                reader.consolidateNamedDestinations();
                reader.removeUnusedObjects();

                // the input FDF
                FdfReader fdf_reader = new FdfReader(args[1]);

                PdfStamper pdf_stamper = new PdfStamper(reader,  new FileOutputStream( args[2] ));

                if (args.length == 4) { // "flatten"
                    // filled-in data becomes a permanent part of the page
                    pdf_stamper.setFormFlattening(true);

                } else {
                    // filled-in data will 'stick' to the form fields,
                    // but it will remain interactive
                    pdf_stamper.setFormFlattening(false);
                }
                // sets the form fields from the input FDF
                AcroFields fields = pdf_stamper.getAcroFields();
                fields.setFields(fdf_reader);
                pdf_stamper.close();

            } catch (Exception ee) {
                ee.printStackTrace();
            }

        } else { // input error
            System.err.println("arguments: file1.pdf file2.fdf destfile [flatten]");
        }
    }
}
