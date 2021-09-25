<?php 
ob_start();
    session_start();
    $pageTitle = 'Career | A to Z for All';

include 'init.php';

?>
<!-- Deutsch Version -->
<?php 
if(isset($_SESSION['ulang']) && $_SESSION['ulang'] == 11){ ?>

<h2>Datenschutzerklärung</h2>
<p>Personenbezogene Daten (nachfolgend zumeist nur „Daten“ genannt) werden von uns nur im Rahmen der Erforderlichkeit sowie zum Zwecke der Bereitstellung eines funktionsfähigen und nutzerfreundlichen Internetauftritts, inklusive seiner Inhalte und der dort angebotenen Leistungen, verarbeitet.</p>
<p>Gemäß Art. 4 Ziffer 1. der Verordnung (EU) 2016/679, also der Datenschutz-Grundverordnung (nachfolgend nur „DSGVO“ genannt), gilt als „Verarbeitung“ jeder mit oder ohne Hilfe automatisierter Verfahren ausgeführter Vorgang oder jede solche Vorgangsreihe im Zusammenhang mit personenbezogenen Daten, wie das Erheben, das Erfassen, die Organisation, das Ordnen, die Speicherung, die Anpassung oder Veränderung, das Auslesen, das Abfragen, die Verwendung, die Offenlegung durch Übermittlung, Verbreitung oder eine andere Form der Bereitstellung, den Abgleich oder die Verknüpfung, die Einschränkung, das Löschen oder die Vernichtung.</p>
<p>Mit der nachfolgenden Datenschutzerklärung informieren wir Sie insbesondere über Art, Umfang, Zweck, Dauer und Rechtsgrundlage der Verarbeitung personenbezogener Daten, soweit wir entweder allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung entscheiden. Zudem informieren wir Sie nachfolgend über die von uns zu Optimierungszwecken sowie zur Steigerung der Nutzungsqualität eingesetzten Fremdkomponenten, soweit hierdurch Dritte Daten in wiederum eigener Verantwortung verarbeiten.</p>
<p>Unsere Datenschutzerklärung ist wie folgt gegliedert:</p>
<p>I. Informationen über uns als Verantwortliche<br>II. Rechte der Nutzer und Betroffenen<br>III. Informationen zur Datenverarbeitung</p>
<h3>I. Informationen über uns als Verantwortliche</h3>
<p>Verantwortlicher Anbieter dieses Internetauftritts im datenschutzrechtlichen Sinne ist:</p>
<p><span style="color: #707070;">Amer Zaza<br>Bochumer Str. 19<br>40472 Düsseldorf<br>Deutschland</span></p>
<p><span style="color: #707070;">Telefon: +49-162-9541011<br>Telefax: <br>E-Mail: datenschutz@a2z4a.de</span></p>
<!--
<p>Datenschutzbeauftragte/r beim Anbieter ist:</p>
<p><span style="color: #707070;">Amer Zaza&nbsp;</span></p>
<p><span style="color: #707070;">[nachfolgende Angaben sind zu ergänzen, sofern ein Externer Datenschutzbeauftragter bestellt ist]</span></p>
<p><span style="color: #707070;">Musterstraße 1<br>12345 Musterstadt<br>Deutschland</span></p>
<p><span style="color: #707070;">Telefon: Telefonnummer<br>Telefax: Faxnummer<br>E-Mail: datenschutz@mustermail.xy</span></p>
-->
<h3>II. Rechte der Nutzer und Betroffenen</h3>
<p>Mit Blick auf die nachfolgend noch näher beschriebene Datenverarbeitung haben die Nutzer und Betroffenen das Recht</p>
<ul>
<li>auf Bestätigung, ob sie betreffende Daten verarbeitet werden, auf Auskunft über die verarbeiteten Daten, auf weitere Informationen über die Datenverarbeitung sowie auf Kopien der Daten (vgl. auch Art. 15 DSGVO);</li>
<li>auf Berichtigung oder Vervollständigung unrichtiger bzw. unvollständiger Daten (vgl. auch Art. 16 DSGVO);</li>
<li>auf unverzügliche Löschung der sie betreffenden Daten (vgl. auch Art. 17 DSGVO), oder, alternativ, soweit eine weitere Verarbeitung gemäß Art. 17 Abs. 3 DSGVO erforderlich ist, auf Einschränkung der Verarbeitung nach Maßgabe von Art. 18 DSGVO;</li>
<li>auf Erhalt der sie betreffenden und von ihnen bereitgestellten Daten und auf Übermittlung dieser Daten an andere Anbieter/Verantwortliche (vgl. auch Art. 20 DSGVO);</li>
<li>auf Beschwerde gegenüber der Aufsichtsbehörde, sofern sie der Ansicht sind, dass die sie betreffenden Daten durch den Anbieter unter Verstoß gegen datenschutzrechtliche Bestimmungen verarbeitet werden (vgl. auch Art. 77 DSGVO).</li>
</ul>
<p>Darüber hinaus ist der Anbieter dazu verpflichtet, alle Empfänger, denen gegenüber Daten durch den Anbieter offengelegt worden sind, über jedwede Berichtigung oder Löschung von Daten oder die Einschränkung der Verarbeitung, die aufgrund der Artikel 16, 17 Abs. 1, 18 DSGVO erfolgt, zu unterrichten. Diese Verpflichtung besteht jedoch nicht, soweit diese Mitteilung unmöglich oder mit einem unverhältnismäßigen Aufwand verbunden ist. Unbeschadet dessen hat der Nutzer ein Recht auf Auskunft über diese Empfänger.</p>
<p><strong>Ebenfalls haben die Nutzer und Betroffenen nach Art. 21 DSGVO das Recht auf Widerspruch gegen die künftige Verarbeitung der sie betreffenden Daten, sofern die Daten durch den Anbieter nach Maßgabe von Art. 6 Abs. 1 lit. f) DSGVO verarbeitet werden. Insbesondere ist ein Widerspruch gegen die Datenverarbeitung zum Zwecke der Direktwerbung statthaft.</strong></p>
<h3>III. Informationen zur Datenverarbeitung</h3>
<p>Ihre bei Nutzung unseres Internetauftritts verarbeiteten Daten werden gelöscht oder gesperrt, sobald der Zweck der Speicherung entfällt, der Löschung der Daten keine gesetzlichen Aufbewahrungspflichten entgegenstehen und nachfolgend keine anderslautenden Angaben zu einzelnen Verarbeitungsverfahren gemacht werden.</p>

<h4>Serverdaten</h4>
<p>Aus technischen Gründen, insbesondere zur Gewährleistung eines sicheren und stabilen Internetauftritts, werden Daten durch Ihren Internet-Browser an uns bzw. an unseren Webspace-Provider übermittelt. Mit diesen sog. Server-Logfiles werden u.a. Typ und Version Ihres Internetbrowsers, das Betriebssystem, die Website, von der aus Sie auf unseren Internetauftritt gewechselt haben (Referrer URL), die Website(s) unseres Internetauftritts, die Sie besuchen, Datum und Uhrzeit des jeweiligen Zugriffs sowie die IP-Adresse des Internetanschlusses, von dem aus die Nutzung unseres Internetauftritts erfolgt, erhoben.</p>
<p>Diese so erhobenen Daten werden vorrübergehend gespeichert, dies jedoch nicht gemeinsam mit anderen Daten von Ihnen.</p>
<p>Diese Speicherung erfolgt auf der Rechtsgrundlage von Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Verbesserung, Stabilität, Funktionalität und Sicherheit unseres Internetauftritts.</p>
<p>Die Daten werden spätestens nach sieben Tage wieder gelöscht, soweit keine weitere Aufbewahrung zu Beweiszwecken erforderlich ist. Andernfalls sind die Daten bis zur endgültigen Klärung eines Vorfalls ganz oder teilweise von der Löschung ausgenommen.</p>

<h4>Cookies</h4>
<h5>a) Sitzungs-Cookies/Session-Cookies</h5>
<p>Wir verwenden mit unserem Internetauftritt sog. Cookies. Cookies sind kleine Textdateien oder andere Speichertechnologien, die durch den von Ihnen eingesetzten Internet-Browser auf Ihrem Endgerät ablegt und gespeichert werden. Durch diese Cookies werden im individuellen Umfang bestimmte Informationen von Ihnen, wie beispielsweise Ihre Browser- oder Standortdaten oder Ihre IP-Adresse, verarbeitet. &nbsp;</p>
<p>Durch diese Verarbeitung wird unser Internetauftritt benutzerfreundlicher, effektiver und sicherer, da die Verarbeitung bspw. die Wiedergabe unseres Internetauftritts in unterschiedlichen Sprachen oder das Angebot einer Warenkorbfunktion ermöglicht.</p>
<p>Rechtsgrundlage dieser Verarbeitung ist Art. 6 Abs. 1 lit b.) DSGVO, sofern diese Cookies Daten zur Vertragsanbahnung oder Vertragsabwicklung verarbeitet werden.</p>
<p>Falls die Verarbeitung nicht der Vertragsanbahnung oder Vertragsabwicklung dient, liegt unser berechtigtes Interesse in der Verbesserung der Funktionalität unseres Internetauftritts. Rechtsgrundlage ist in dann Art. 6 Abs. 1 lit. f) DSGVO.</p>
<p>Mit Schließen Ihres Internet-Browsers werden diese Session-Cookies gelöscht.</p>
<h5>b) Drittanbieter-Cookies</h5>
<p>Gegebenenfalls werden mit unserem Internetauftritt auch Cookies von Partnerunternehmen, mit denen wir zum Zwecke der Werbung, der Analyse oder der Funktionalitäten unseres Internetauftritts zusammenarbeiten, verwendet.</p>
<p>Die Einzelheiten hierzu, insbesondere zu den Zwecken und den Rechtsgrundlagen der Verarbeitung solcher Drittanbieter-Cookies, entnehmen Sie bitte den nachfolgenden Informationen.</p>
<h5>c) Beseitigungsmöglichkeit</h5>
<p>Sie können die Installation der Cookies durch eine Einstellung Ihres Internet-Browsers verhindern oder einschränken. Ebenfalls können Sie bereits gespeicherte Cookies jederzeit löschen. Die hierfür erforderlichen Schritte und Maßnahmen hängen jedoch von Ihrem konkret genutzten Internet-Browser ab. Bei Fragen benutzen Sie daher bitte die Hilfefunktion oder Dokumentation Ihres Internet-Browsers oder wenden sich an dessen Hersteller bzw. Support. Bei sog. Flash-Cookies kann die Verarbeitung allerdings nicht über die Einstellungen des Browsers unterbunden werden. Stattdessen müssen Sie insoweit die Einstellung Ihres Flash-Players ändern. Auch die hierfür erforderlichen Schritte und Maßnahmen hängen von Ihrem konkret genutzten Flash-Player ab. Bei Fragen benutzen Sie daher bitte ebenso die Hilfefunktion oder Dokumentation Ihres Flash-Players oder wenden sich an den Hersteller bzw. Benutzer-Support.</p>
<p>Sollten Sie die Installation der Cookies verhindern oder einschränken, kann dies allerdings dazu führen, dass nicht sämtliche Funktionen unseres Internetauftritts vollumfänglich nutzbar sind. </p>

<h4>Vertragsabwicklung</h4>
<p>Die von Ihnen zur Inanspruchnahme unseres Waren- und/oder Dienstleistungsangebots übermittelten Daten werden von uns zum Zwecke der Vertragsabwicklung verarbeitet und sind insoweit erforderlich. Vertragsschluss und Vertragsabwicklung sind ohne Bereitstellung Ihrer Daten nicht möglich.</p>
<p>Rechtsgrundlage für die Verarbeitung ist Art. 6 Abs. 1 lit. b) DSGVO.</p>
<p>Wir löschen die Daten mit vollständiger Vertragsabwicklung, müssen dabei aber die steuer- und handelsrechtlichen Aufbewahrungsfristen beachten.</p>
<p>Im Rahmen der Vertragsabwicklung geben wir Ihre Daten an das mit der Warenlieferung beauftragte Transportunternehmen oder an den Finanzdienstleister weiter, soweit die Weitergabe zur Warenauslieferung oder zu Bezahlzwecken erforderlich ist.</p>
<p>Rechtsgrundlage für die Weitergabe der Daten ist dann Art. 6 Abs. 1 lit. b) DSGVO.</p>

<h4>Kundenkonto / Registrierungsfunktion</h4>
<p>Falls Sie über unseren Internetauftritt ein Kundenkonto bei uns anlegen, werden wir die von Ihnen bei der Registrierung eingegebenen Daten (also bspw. Ihren Namen, Ihre Anschrift oder Ihre E-Mail-Adresse) ausschließlich für vorvertragliche Leistungen, für die Vertragserfüllung oder zum Zwecke der Kundenpflege (bspw. um Ihnen eine Übersicht über Ihre bisherigen Bestellungen bei uns zur Verfügung zu stellen oder um Ihnen die sog. Merkzettelfunktion anbieten zu können) erheben und speichern. Gleichzeitig speichern wir dann die IP-Adresse und das Datum Ihrer Registrierung nebst Uhrzeit. Eine Weitergabe dieser Daten an Dritte erfolgt natürlich nicht.</p>
<p>Im Rahmen des weiteren Anmeldevorgangs wird Ihre Einwilligung in diese Verarbeitung eingeholt und auf diese Datenschutzerklärung verwiesen. Die dabei von uns erhobenen Daten werden ausschließlich für die Zurverfügungstellung des Kundenkontos verwendet.&nbsp;</p>
<p>Soweit Sie in diese Verarbeitung einwilligen, ist Art. 6 Abs. 1 lit. a) DSGVO Rechtsgrundlage für die Verarbeitung.</p>
<p>Sofern die Eröffnung des Kundenkontos zusätzlich auch vorvertraglichen Maßnahmen oder der Vertragserfüllung dient, so ist Rechtsgrundlage für diese Verarbeitung auch noch Art. 6 Abs. 1 lit. b) DSGVO.</p>
<p>Die uns erteilte Einwilligung in die Eröffnung und den Unterhalt des Kundenkontos können Sie gemäß Art. 7 Abs. 3 DSGVO jederzeit mit Wirkung für die Zukunft widerrufen. Hierzu müssen Sie uns lediglich über Ihren Widerruf in Kenntnis setzen.</p>
<p>Die insoweit erhobenen Daten werden gelöscht, sobald die Verarbeitung nicht mehr erforderlich ist. Hierbei müssen wir aber steuer- und handelsrechtliche Aufbewahrungsfristen beachten.</p>

<h4>Newsletter</h4>
<p>Falls Sie sich für unseren kostenlosen Newsletter anmelden, werden die von Ihnen hierzu abgefragten Daten, also Ihre E-Mail-Adresse sowie - optional - Ihr Name und Ihre Anschrift, an uns übermittelt. Gleichzeitig speichern wir die IP-Adresse des Internetanschlusses von dem aus Sie auf unseren Internetauftritt zugreifen sowie Datum und Uhrzeit Ihrer Anmeldung. Im Rahmen des weiteren Anmeldevorgangs werden wir Ihre Einwilligung in die Übersendung des Newsletters einholen, den Inhalt konkret beschreiben und auf diese Datenschutzerklärung verwiesen. Die dabei erhobenen Daten verwenden wir ausschließlich für den Newsletter-Versand – sie werden deshalb insbesondere auch nicht an Dritte weitergegeben.</p>
<p>Rechtsgrundlage hierbei ist Art. 6 Abs. 1 lit. a) DSGVO.</p>
<p>Die Einwilligung in den Newsletter-Versand können Sie gemäß Art. 7 Abs. 3 DSGVO jederzeit mit Wirkung für die Zukunft widerrufen. Hierzu müssen Sie uns lediglich über Ihren Widerruf in Kenntnis setzen oder den in jedem Newsletter enthaltenen Abmeldelink betätigen.</p>

<h4>Kontaktanfragen / Kontaktmöglichkeit</h4>
<p>Sofern Sie per Kontaktformular oder E-Mail mit uns in Kontakt treten, werden die dabei von Ihnen angegebenen Daten zur Bearbeitung Ihrer Anfrage genutzt. Die Angabe der Daten ist zur Bearbeitung und Beantwortung Ihre Anfrage erforderlich - ohne deren Bereitstellung können wir Ihre Anfrage nicht oder allenfalls eingeschränkt beantworten.</p>
<p>Rechtsgrundlage für diese Verarbeitung ist Art. 6 Abs. 1 lit. b) DSGVO.</p>
<p>Ihre Daten werden gelöscht, sofern Ihre Anfrage abschließend beantwortet worden ist und der Löschung keine gesetzlichen Aufbewahrungspflichten entgegenstehen, wie bspw. bei einer sich etwaig anschließenden Vertragsabwicklung.</p>

<h4>Nutzerbeiträge, Kommentare und Bewertungen</h4>
<p>Wir bieten Ihnen an, auf unseren Internetseiten Fragen, Antworten, Meinungen oder Bewertungen, nachfolgend nur „Beiträge genannt, zu veröffentlichen. Sofern Sie dieses Angebot in Anspruch nehmen, verarbeiten und veröffentlichen wir Ihren Beitrag, Datum und Uhrzeit der Einreichung sowie das von Ihnen ggf. genutzte Pseudonym.</p>
<p>Rechtsgrundlage hierbei ist Art. 6 Abs. 1 lit. a) DSGVO. Die Einwilligung können Sie gemäß Art. 7 Abs. 3 DSGVO jederzeit mit Wirkung für die Zukunft widerrufen. Hierzu müssen Sie uns lediglich über Ihren Widerruf in Kenntnis setzen.</p>
<p>Darüber hinaus verarbeiten wir auch Ihre IP- und E-Mail-Adresse. Die IP-Adresse wird verarbeitet, weil wir ein berechtigtes Interesse daran haben, weitere Schritte einzuleiten oder zu unterstützen, sofern Ihr Beitrag in Rechte Dritter eingreift und/oder er sonst wie rechtswidrig erfolgt.</p>
<p>Rechtsgrundlage ist in diesem Fall Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der ggf. notwendigen Rechtsverteidigung.</p>

<h4>Abonnement von Beiträgen</h4>
<p>Sofern Sie Beiträge auf unseren Internetseiten veröffentlichen, bieten wir Ihnen zusätzlich an, etwaige Folgebeiträge Dritter zu abonnieren. Um Sie über diese Folgebeiträge per E-Mail informieren zu können, verarbeiten wir Ihre E-Mail-Adresse.</p>
<p>Rechtsgrundlage hierbei ist Art. 6 Abs. 1 lit. a) DSGVO. Die Einwilligung in dieses Abonnement können Sie gemäß Art. 7 Abs. 3 DSGVO jederzeit mit Wirkung für die Zukunft widerrufen. Hierzu müssen Sie uns lediglich über Ihren Widerruf in Kenntnis setzen oder den in der jeweiligen E-Mail enthaltenen Abmeldelink betätigen.</p>

<h4>Google Analytics</h4>
<p>In unserem Internetauftritt setzen wir Google Analytics ein. Hierbei handelt es sich um einen Webanalysedienst der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Der Dienst Google Analytics dient zur Analyse des Nutzungsverhaltens unseres Internetauftritts. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Analyse, Optimierung und dem wirtschaftlichen Betrieb unseres Internetauftritts.</p>
<p>Nutzungs- und nutzerbezogene Informationen, wie bspw. IP-Adresse, Ort, Zeit oder Häufigkeit des Besuchs unseres Internetauftritts, werden dabei an einen Server von Google in den USA übertragen und dort gespeichert. Allerdings nutzen wir Google Analytics mit der sog. Anonymisierungsfunktion. Durch diese Funktion kürzt Google die IP-Adresse schon innerhalb der EU bzw. des EWR.</p>
<p>Die so erhobenen Daten werden wiederum von Google genutzt, um uns eine Auswertung über den Besuch unseres Internetauftritts sowie über die dortigen Nutzungsaktivitäten zur Verfügung zu stellen. Auch können diese Daten genutzt werden, um weitere Dienstleistungen zu erbringen, die mit der Nutzung unseres Internetauftritts und der Nutzung des Internets zusammenhängen.</p>
<p>Google gibt an, Ihre IP-Adresse nicht mit anderen Daten zu verbinden. Zudem hält Google unter</p>
<p><a target="_blank" rel="noopener" href="https://www.google.com/intl/de/policies/privacy/partners">https://www.google.com/intl/de/policies/privacy/partners</a></p>
<p>weitere datenschutzrechtliche Informationen für Sie bereit, so bspw. auch zu den Möglichkeiten, die Datennutzung zu unterbinden.</p>
<p>Zudem bietet Google unter</p>
<p><a target="_blank" rel="noopener" href="https://tools.google.com/dlpage/gaoptout?hl=de">https://tools.google.com/dlpage/gaoptout?hl=de</a></p>
<p>ein sog. Deaktivierungs-Add-on nebst weiteren Informationen hierzu an. Dieses Add-on lässt sich mit den gängigen Internet-Browsern installieren und bietet Ihnen weitergehende Kontrollmöglichkeit über die Daten, die Google bei Aufruf unseres Internetauftritts erfasst. Dabei teilt das Add-on dem JavaScript (ga.js) von Google Analytics mit, dass Informationen zum Besuch unseres Internetauftritts nicht an Google Analytics übermittelt werden sollen. Dies verhindert aber nicht, dass Informationen an uns oder an andere Webanalysedienste übermittelt werden. Ob und welche weiteren Webanalysedienste von uns eingesetzt werden, erfahren Sie natürlich ebenfalls in dieser Datenschutzerklärung.</p>

<h4>„Google+“-Social-Plug-in</h4>
<p>In unserem Internetauftritt setzen wir das Plug-in des Social-Networks Google+ („Google Plus“) ein. Bei Google+ handelt es sich um einen Internetservice der Google LLC., 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Qualitätsverbesserung unseres Internetauftritts.</p>
<p>Weitergehende Informationen über die möglichen Plug-ins sowie über deren jeweilige Funktionen hält Google unter</p>
<p><a target="_blank" rel="noopener" href="https://developers.google.com/+/web/">https://developers.google.com/+/web/</a>&nbsp;</p>
<p>für Sie bereit.</p>
<p>Sofern das Plug-in auf einer der von Ihnen besuchten Seiten unseres Internetauftritts hinterlegt ist, lädt Ihr Internet-Browser eine Darstellung des Plug-ins von den Servern von Google in den USA herunter. Aus technischen Gründen ist es dabei notwendig, dass Google Ihre IP-Adresse verarbeitet. Daneben werden aber auch Datum und Uhrzeit des Besuchs unserer Internetseiten erfasst.</p>
<p>Sollten Sie bei Google eingeloggt sein, während Sie eine unserer mit dem Plug-in versehenen Internetseite besuchen, werden die durch das Plug-in gesammelten Informationen Ihres konkreten Besuchs von Google erkannt. Die so gesammelten Informationen weist Google womöglich Ihrem dortigen persönlichen Nutzerkonto zu. Sofern Sie also bspw. den sog. „Teilen“-Button von Google benutzen, werden diese Informationen in Ihrem Google-Nutzerkonto gespeichert und ggf. über die Plattform von Google veröffentlicht. Wenn Sie das verhindern möchten, müssen Sie sich entweder vor dem Besuch unseres Internetauftritts bei Google ausloggen oder die entsprechenden Einstellungen in Ihrem Google-Benutzerkonto vornehmen.</p>
<p>Weitergehende Informationen über die Erhebung und Nutzung von Daten sowie Ihre diesbezüglichen Rechte und Schutzmöglichkeiten hält Google in den unter</p>
<p><a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p>abrufbaren Datenschutzhinweisen bereit.</p>

<h4>Google-Maps</h4>
<p>In unserem Internetauftritt setzen wir Google Maps zur Darstellung unseres Standorts sowie zur Erstellung einer Anfahrtsbeschreibung ein. Es handelt sich hierbei um einen Dienst der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Um die Darstellung bestimmter Schriften in unserem Internetauftritt zu ermöglichen, wird bei Aufruf unseres Internetauftritts eine Verbindung zu dem Google-Server in den USA aufgebaut.</p>
<p>Sofern Sie die in unseren Internetauftritt eingebundene Komponente Google Maps aufrufen, speichert Google über Ihren Internet-Browser ein Cookie auf Ihrem Endgerät. Um unseren Standort anzuzeigen und eine Anfahrtsbeschreibung zu erstellen, werden Ihre Nutzereinstellungen und -daten verarbeitet. Hierbei können wir nicht ausschließen, dass Google Server in den USA einsetzt.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Optimierung der Funktionalität unseres Internetauftritts.</p>
<p>Durch die so hergestellte Verbindung zu Google kann Google ermitteln, von welcher Website Ihre Anfrage gesendet worden ist und an welche IP-Adresse die Anfahrtsbeschreibung zu übermitteln ist.</p>
<p>Sofern Sie mit dieser Verarbeitung nicht einverstanden sind, haben Sie die Möglichkeit, die Installation der Cookies durch die entsprechenden Einstellungen in Ihrem Internet-Browser zu verhindern. Einzelheiten hierzu finden Sie vorstehend unter dem Punkt „Cookies“.</p>
<p>Zudem erfolgt die Nutzung von Google Maps sowie der über Google Maps erlangten Informationen nach den <a target="_blank" rel="noopener" href="http://www.google.de/accounts/TOS">Google-Nutzungsbedingungen</a>&nbsp;<a target="_blank" rel="noopener" href="https://policies.google.com/terms?gl=DE&amp;hl=de">https://policies.google.com/terms?gl=DE&amp;hl=de</a> und den <a target="_blank" rel="noopener" href="http://www.google.com/intl/de_de/help/terms_maps.html">Geschäftsbedingungen für Google Maps</a> https://www.google.com/intl/de_de/help/terms_maps.html.</p>
<p>Überdies bietet Google unter</p>
<p><a target="_blank" rel="noopener" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a></p>
<p><a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p>weitergehende Informationen an.</p>

<h4>Google Fonts</h4>
<p>In unserem Internetauftritt setzen wir Google Fonts zur Darstellung externer Schriftarten ein. Es handelt sich hierbei um einen Dienst der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Um die Darstellung bestimmter Schriften in unserem Internetauftritt zu ermöglichen, wird bei Aufruf unseres Internetauftritts eine Verbindung zu dem Google-Server in den USA aufgebaut.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Optimierung und dem wirtschaftlichen Betrieb unseres Internetauftritts.</p>
<p>Durch die bei Aufruf unseres Internetauftritts hergestellte Verbindung zu Google kann Google ermitteln, von welcher Website Ihre Anfrage gesendet worden ist und an welche IP-Adresse die Darstellung der Schrift zu übermitteln ist.</p>
<p>Google bietet unter</p>
<p><a target="_blank" rel="noopener" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a></p>
<p><a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p>weitere Informationen an und zwar insbesondere zu den Möglichkeiten der Unterbindung der Datennutzung.</p>

<h4>„Facebook“-Social-Plug-in</h4>
<p>In unserem Internetauftritt setzen wir das Plug-in des Social-Networks Facebook ein. Bei Facebook handelt es sich um einen Internetservice der facebook Inc., 1601 S. California Ave, Palo Alto, CA 94304, USA. In der EU wird dieser Service wiederum von der Facebook Ireland Limited, 4 Grand Canal Square, Dublin 2, Irland, betrieben, nachfolgend beide nur „Facebook“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active</a></p>
<p>garantiert Facebook, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Qualitätsverbesserung unseres Internetauftritts.</p>
<p>Weitergehende Informationen über die möglichen Plug-ins sowie über deren jeweilige Funktionen hält Facebook unter</p>
<p><a target="_blank" rel="noopener" href="https://developers.facebook.com/docs/plugins/">https://developers.facebook.com/docs/plugins/</a></p>
<p>für Sie bereit.</p>
<p>Sofern das Plug-in auf einer der von Ihnen besuchten Seiten unseres Internetauftritts hinterlegt ist, lädt Ihr Internet-Browser eine Darstellung des Plug-ins von den Servern von Facebook in den USA herunter. Aus technischen Gründen ist es dabei notwendig, dass Facebook Ihre IP-Adresse verarbeitet. Daneben werden aber auch Datum und Uhrzeit des Besuchs unserer Internetseiten erfasst.</p>
<p>Sollten Sie bei Facebook eingeloggt sein, während Sie eine unserer mit dem Plug-in versehenen Internetseite besuchen, werden die durch das Plug-in gesammelten Informationen Ihres konkreten Besuchs von Facebook erkannt. Die so gesammelten Informationen weist Facebook womöglich Ihrem dortigen persönlichen Nutzerkonto zu. Sofern Sie also bspw. den sog. „Gefällt mir“-Button von Facebook benutzen, werden diese Informationen in Ihrem Facebook-Nutzerkonto gespeichert und ggf. über die Plattform von Facebook veröffentlicht. Wenn Sie das verhindern möchten, müssen Sie sich entweder vor dem Besuch unseres Internetauftritts bei Facebook ausloggen oder durch den Einsatz eines Add-ons für Ihren Internetbrowser verhindern, dass das Laden des Facebook-Plug-in blockiert wird.</p>
<p>Weitergehende Informationen über die Erhebung und Nutzung von Daten sowie Ihre diesbezüglichen Rechte und Schutzmöglichkeiten hält Facebook in den unter</p>
<p><a target="_blank" rel="noopener" href="https://www.facebook.com/policy.php">https://www.facebook.com/policy.php</a></p>
<p>abrufbaren Datenschutzhinweisen bereit.</p>

<h4>YouTube</h4>
<p>In unserem Internetauftritt setzen wir YouTube ein. Hierbei handelt es sich um ein Videoportal der YouTube LLC., 901 Cherry Ave., 94066 San Bruno, CA, USA, nachfolgend nur „YouTube“ genannt.</p>
<p>YouTube ist ein Tochterunternehmen der Google LLC., 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google und damit auch das Tochterunternehmen YouTube, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Wir nutzen YouTube im Zusammenhang mit der Funktion „Erweiterter Datenschutzmodus“, um Ihnen Videos anzeigen zu können. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Qualitätsverbesserung unseres Internetauftritts. Die Funktion „Erweiterter Datenschutzmodus“ bewirkt laut Angaben von YouTube, dass die nachfolgend noch näher bezeichneten Daten nur dann an den Server von YouTube übermittelt werden, wenn Sie ein Video auch tatsächlich starten.</p>
<p>Ohne diesen „Erweiterten Datenschutz“ wird eine Verbindung zum Server von YouTube in den USA hergestellt, sobald Sie eine unserer Internetseiten, auf der ein YouTube-Video eingebettet ist, aufrufen.</p>
<p>Diese Verbindung ist erforderlich, um das jeweilige Video auf unserer Internetseite über Ihren Internet-Browser darstellen zu können. Im Zuge dessen wird YouTube zumindest Ihre IP-Adresse, das Datum nebst Uhrzeit sowie die von Ihnen besuchte Internetseite erfassen und verarbeiten. Zudem wird eine Verbindung zu dem Werbenetzwerk „DoubleClick“ von Google hergestellt.</p>
<p>Sollten Sie gleichzeitig bei YouTube eingeloggt sein, weist YouTube die Verbindungsinformationen Ihrem YouTube-Konto zu. Wenn Sie das verhindern möchten, müssen Sie sich entweder vor dem Besuch unseres Internetauftritts bei YouTube ausloggen oder die entsprechenden Einstellungen in Ihrem YouTube-Benutzerkonto vornehmen.</p>
<p>Zum Zwecke der Funktionalität sowie zur Analyse des Nutzungsverhaltens speichert YouTube dauerhaft Cookies über Ihren Internet-Browser auf Ihrem Endgerät. Falls Sie mit dieser Verarbeitung nicht einverstanden sind, haben Sie die Möglichkeit, die Speicherung der Cookies durch eine Einstellung in Ihrem Internet-Browsers zu verhindern. Nähere Informationen hierzu finden Sie vorstehend unter „Cookies“.</p>
<p>Weitergehende Informationen über die Erhebung und Nutzung von Daten sowie Ihre diesbezüglichen Rechte und Schutzmöglichkeiten hält Google in den unter</p>
<p><a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p>abrufbaren Datenschutzhinweisen bereit.</p>

<h4>Webanalyse etracker</h4>
<p>In unserem Internetauftritt setzen wir etracker ein. Hierbei handelt es sich um einen Webanalysedienst der etracker GmbH, Erste Brunnenstr. 1, 20459 Hamburg, nachfolgend nur „etracker“ genannt.</p>
<p>etracker dient uns zur Analyse des Nutzungsverhaltens unseres Internetauftritts. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Analyse, Optimierung und dem wirtschaftlichen Betrieb unseres Internetauftritts.</p>
<p>Zur Analyse des Nutzungsverhaltens speichert etracker Cookies über Ihren Internet-Browser auf Ihrem Endgerät und erstellt dabei ein pseudonymes Nutzungsprofil. Die dabei verarbeiteten Daten werden allerdings nicht ohne Ihre gesonderte Zustimmung zu Ihrer persönlichen Identifikation verwendet. Genauso wenig werden diese Daten mit anderen personenbezogenen Daten zusammengeführt.</p>
<p>Falls Sie mit dieser Verarbeitung nicht einverstanden sind, haben Sie die Möglichkeit, die Speicherung des Cookies durch eine Einstellung in Ihrem Internet-Browsers zu verhindern. Nähere Informationen hierzu finden Sie vorstehend unter „Cookies“.</p>
<p>Darüber hinaus haben Sie die Möglichkeit, die Analyse Ihres Nutzungsverhaltens im Wege des sog. Opt-outs zu beenden. Mit dem Bestätigen des Links</p>
<p><a target="_blank" rel="noopener" href="http://www.etracker.de/privacy?et=V23Jbb">http://www.etracker.de/privacy?et=V23Jbb</a></p>
<p>wird über Ihren Internet-Browser ein Cookie auf Ihrem Endgerät gespeichert, das die weitere Analyse verhindert. Bitte beachten Sie aber, dass Sie den obigen Link erneut betätigen müssen, sofern Sie die auf Ihrem Endgerät gespeicherten Cookies löschen.</p>

<h4>„Shariff“-Social-Media-Buttons</h4>
<p>In unserem Internetauftritt setzten wir die Plug-ins der nachfolgend genannten Social-Networks ein. Zur Einbindung dieser Plug-ins nutzen wir wiederum das Plug-in „Shariff“.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Qualitätsverbesserung unseres Internetauftritts</p>
<p>Shariff ist ein Open-Source-Programm, das von c’t und heise entwickelt worden ist. Durch die Einbindung dieses Plug-ins wird im Wege verlinkter Grafiken verhindert, dass die nachfolgend näher benannten Social-Network-Plug-ins bei Ihrem Besuch unserer Internetseite(n), auf der/denen wiederum das jeweilige Social-Network-Plug-in eingebunden ist, automatisch eine Verbindung zu dem jeweiligen Server des Social-Network-Plug-ins herstellt. Erst wenn Sie auf eine dieser verlinkten Grafiken klicken, werden Sie zu dem Dienst des jeweiligen Social-Networks weitergeleitet. Auch erst dann werden durch das jeweilige Social-Network Informationen über den Nutzungsvorgang erfasst. Zu diesen Informationen zählen bspw. Ihre IP-Adresse, das Datum nebst Uhrzeit sowie die von Ihnen besuchte Seite unseres Internetauftritts.</p>
<p>Sollten Sie bei einem der Social-Network-Dienste eingeloggt sein, während Sie eine unserer mit dem damit korrespondieren Plug-in versehenen Internetseite besuchen, kann der Anbieter des jeweiligen Social-Networks womöglich die so gesammelten Informationen Ihres konkreten Besuchs erkennen und Ihrem persönlichen Nutzerkonto zuordnen bzw. hierüber veröffentlichen. Sofern Sie also bspw. den sog. „Teilen“-Button des jeweiligen Social-Networks benutzen, werden diese Informationen ggf. in Ihrem dortigen Nutzerkonto gespeichert und über die Plattform des jeweiligen Social-Network-Anbieters veröffentlicht. Wenn Sie das verhindern möchten, müssen Sie sich entweder vor dem Klick auf die Grafik bei dem jeweiligen Social-Network ausloggen oder die entsprechenden Einstellungen in Ihrem Benutzerkonto des Social-Networks vornehmen.</p>
<p>Weitergehende Informationen über „Shariff“ hält heise unter</p>
<p><a target="_blank" rel="noopener" href="http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html">http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html</a></p>
<p>bereit.</p>
<p>Folgende Social-Networks sind in unseren Internetauftritt eingebunden:</p>
<p><strong>Google+</strong> der Google LLC, 1600 Amphitheatre Parkway, Mountain View, Kalifornien, 94043, USA.</p>
<p>Datenschutzinformationen sind zu finden unter <a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p><strong>Facebook</strong> der Facebook Inc., 1601 S. California Ave, Palo Alto, CA 94304, USA, betrieben innerhalb der EU durch Facebook Ireland Limited, 4 Grand Canal Square, Dublin 2, Irland.&nbsp;</p>
<p>Datenschutzinformationen sind zu finden unter <a target="_blank" rel="noopener" href="https://www.facebook.com/policy.php">https://www.facebook.com/policy.php</a></p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active</a></p>
<p>garantiert Facebook, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p><strong>Twitter</strong> der Twitter Inc., 795 Folsom St., Suite 600, San Francisco, CA 94107, USA.</p>
<p>Datenschutzinformationen sind zu finden unter <a target="_blank" rel="noopener" href="https://twitter.com/privacy">https://twitter.com/privacy</a></p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&amp;status=Active</a></p>
<p>garantiert Twitter, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>

<h4>Google AdWords mit Conversion-Tracking</h4>
<p>In unserem Internetauftritt setzen wir die Werbe-Komponente Google AdWords und dabei das sog. Conversion-Tracking ein. Es handelt sich hierbei um einen Dienst der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Wir nutzen das Conversion-Tracking zur zielgerichteten Bewerbung unseres Angebots. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Analyse, Optimierung und dem wirtschaftlichen Betrieb unseres Internetauftritts.</p>
<p>Falls Sie auf eine von Google geschaltete Anzeige klicken, speichert das von uns eingesetzte Conversion-Tracking ein Cookie auf Ihrem Endgerät. Diese sog. Conversion-Cookies verlieren mit Ablauf von 30 Tagen ihre Gültigkeit und dienen im Übrigen nicht Ihrer persönlichen Identifikation.</p>
<p>Sofern das Cookie noch gültig ist und Sie eine bestimmte Seite unseres Internetauftritts besuchen, können sowohl wir als auch Google auswerten, dass Sie auf eine unserer bei Google platzierten Anzeigen geklickt haben und dass Sie anschließend auf unseren Internetauftritt weitergeleitet worden sind.</p>
<p>Durch die so eingeholten Informationen erstellt Google uns eine Statistik über den Besuch unseres Internetauftritts. Zudem erhalten wir hierdurch Informationen über die Anzahl der Nutzer, die auf unsere Anzeige(n) geklickt haben sowie über die anschließend aufgerufenen Seiten unseres Internetauftritts. Weder wir noch Dritte, die ebenfalls Google-AdWords einsetzten, werden hierdurch allerdings in die Lage versetzt, Sie auf diesem Wege zu identifizieren.</p>
<p>Durch die entsprechenden Einstellungen Ihres Internet-Browsers können Sie zudem die Installation der Cookies verhindern oder einschränken. Gleichzeitig können Sie bereits gespeicherte Cookies jederzeit löschen. Die hierfür erforderlichen Schritte und Maßnahmen hängen jedoch von Ihrem konkret genutzten Internet-Browser ab. Bei Fragen benutzen Sie daher bitte die Hilfefunktion oder Dokumentation Ihres Internet-Browsers oder wenden sich an dessen Hersteller bzw. Support.</p>
<p>Ferner bietet auch Google unter</p>
<p><a target="_blank" rel="noopener" href="https://services.google.com/sitestats/de.html">https://services.google.com/sitestats/de.html</a></p>
<p><a target="_blank" rel="noopener" href="http://www.google.com/policies/technologies/ads/">http://www.google.com/policies/technologies/ads/</a>&nbsp;</p>
<p><a target="_blank" rel="noopener" href="http://www.google.de/policies/privacy/">http://www.google.de/policies/privacy/</a></p>
<p>weitergehende Informationen zu diesem Thema und dabei insbesondere zu den Möglichkeiten der Unterbindung der Datennutzung an.</p>

<h4>Google AdSense</h4>
<p>In unserem Internetauftritt setzen wir zur Einbindung von Werbeanzeigen Google AdSense ein. Es handelt sich hierbei um einen Dienst der Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, nachfolgend nur „Google“ genannt.</p>
<p>Durch die Zertifizierung nach dem EU-US-Datenschutzschild („EU-US Privacy Shield“)</p>
<p><a target="_blank" rel="noopener" href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>garantiert Google, dass die Datenschutzvorgaben der EU auch bei der Verarbeitung von Daten in den USA eingehalten werden.</p>
<p>Durch Google AdSense werden Cookies sowie sog. Web Beacons über Ihren Internet-Browser auf Ihrem Endgerät gespeichert. Hierdurch ermöglicht uns Google die Analyse der Nutzung unseres Internetauftritts durch Sie. Die so erfassten Informationen werden neben Ihrer IP-Adresse und der Ihnen angezeigten Werbeformate an Google in die USA übertragen und dort gespeichert. Ferner kann Google diese Informationen an Vertragspartner weitergeben. Google erklärt allerdings, dass Ihre IP-Adresse nicht mit anderen Daten von Ihnen zusammengeführt würden.</p>
<p>Rechtsgrundlage ist Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der Analyse, Optimierung und dem wirtschaftlichen Betrieb unseres Internetauftritts.</p>
<p>Sofern Sie mit dieser Verarbeitung nicht einverstanden sind, haben Sie die Möglichkeit, die Installation der Cookies durch die entsprechenden Einstellungen in Ihrem Internet-Browser zu verhindern. Einzelheiten hierzu finden Sie vorstehend unter dem Punkt „Cookies“.</p>
<p>Zudem bietet Google unter</p>
<p><a target="_blank" rel="noopener" href="https://policies.google.com/privacy">https://policies.google.com/privacy</a></p>
<p><a target="_blank" rel="noopener" href="https://adssettings.google.com/authenticated">https://adssettings.google.com/authenticated</a></p>
<p>weitere Informationen an und zwar insbesondere zu den Möglichkeiten der Unterbindung der Datennutzung.</p>

<h4>affilinet-Tracking-Cookies</h4>
<p>In unserem Internetauftritt bewerben wir auch Angebote und Leistungen Dritter. Sofern Sie aufgrund unserer Werbung für diese Drittangebote einen Vertrag mit dem Drittanbieter schließen, erhalten wir hierfür eine Provision.</p>
<p>Um die erfolgreiche Vermittlung korrekt erfassen zu können, setzen wir das sog. affilinet-Tracking-Cookie ein. Dieses Cookie speichert aber keine Ihrer personenbezogenen Daten. Es wird lediglich unsere Identifikationsnummer als vermittelnder Anbieter sowie die Ordnungsnummer des von Ihnen angeklickten Werbemittels (bspw. eines Banners oder eines Textlinks) erfasst. Diese Informationenbenötigen wir zum Zwecke der Zahlungsabwicklung bzw. Auszahlung unserer Provisionen.</p>
<p>Falls Sie mit dieser Verarbeitung nicht einverstanden sind, haben Sie die Möglichkeit, die Speicherung der Cookies durch eine Einstellung in Ihrem Internet-Browsers zu verhindern. Nähere Informationen hierzu finden Sie vorstehend unter „Cookies“.</p>

<!--
<p>
<a target="_blank" href="https://www.ratgeberrecht.eu/leistungen/muster-datenschutzerklaerung.html">Muster-Datenschutzerklärung</a> der <a target="_blank" href="https://www.ratgeberrecht.eu/">Anwaltskanzlei Weiß &amp; Partner</a></p>
-->
<?php }else{ ?>
<!-- English Version-->

<h2>Privacy Policy</h2>
<p>Personal data (usually referred to just as "data" below) will only be processed by us to the extent necessary and for the purpose of providing a functional and user-friendly website, including its contents, and the services offered there.</p>
<p>Per Art. 4 No. 1 of Regulation (EU) 2016/679, i.e. the General Data Protection Regulation (hereinafter referred to as the "GDPR"), "processing" refers to any operation or set of operations such as collection, recording, organization, structuring, storage, adaptation, alteration, retrieval, consultation, use, disclosure by transmission, dissemination, or otherwise making available, alignment, or combination, restriction, erasure, or destruction performed on personal data, whether by automated means or not.</p>
<p>The following privacy policy is intended to inform you in particular about the type, scope, purpose, duration, and legal basis for the processing of such data either under our own control or in conjunction with others. We also inform you below about the third-party components we use to optimize our website and improve the user experience which may result in said third parties also processing data they collect and control.</p>
<p>Our privacy policy is structured as follows:</p>
<p>I. Information about us as controllers of your data<br>II. The rights of users and data subjects<br>III. Information about the data processing</p>
<h3>I. Information about us as controllers of your data</h3>
<p>The party responsible for this website (the "controller") for purposes of data protection law is:</p>
<p><span style="color: #707070;">Amer Zaza<br>Bochumer Str. 19<br>40472 Düsseldorf<br>Deutschland</span></p>
<p><span style="color: #707070;">Telefon: +49-162-9541011<br>Telefax: <br>E-Mail: datenschutz@a2z4a.de</span></p>
<!--
<p>The controller's data protection officer is:</p>
<p><span style="color: #707070;">Maxie Musterfrau&nbsp;</span></p>
<p><span style="color: #707070;">[The following information must be added if an external data protection officer has been appointed].</span></p>
<p><span style="color: #707070;">Any street 1</span><br><span style="color: #707070;">12345 Anytown</span><br><span style="color: #707070;">Germany</span></p>
<p><span style="color: #707070;">Telephone: Telephone number</span><br><span style="color: #707070;">Fax: Fax number</span><br><span style="color: #707070;">Email: datenschutz@mustermail.xy</span></p>
-->
<h3>II. The rights of users and data subjects</h3>
<p>With regard to the data processing to be described in more detail below, users and data subjects have the right</p>
<ul type="disc">
<li>to confirmation of whether data concerning them is being processed, information about the data being processed, further information about the nature of the data processing, and copies of the data (cf. also Art. 15 GDPR);</li>
<li>to correct or complete incorrect or incomplete data (cf. also Art. 16 GDPR);</li>
<li>to the immediate deletion of data concerning them (cf. also Art. 17 DSGVO), or, alternatively, if further processing is necessary as stipulated in Art. 17 Para. 3 GDPR, to restrict said processing per Art. 18 GDPR;</li>
<li>to receive copies of the data concerning them and/or provided by them and to have the same transmitted to other providers/controllers (cf. also Art. 20 GDPR);</li>
<li>to file complaints with the supervisory authority if they believe that data concerning them is being processed by the controller in breach of data protection provisions (see also Art. 77 GDPR).</li>
</ul>
<p>In addition, the controller is obliged to inform all recipients to whom it discloses data of any such corrections, deletions, or restrictions placed on processing the same per Art. 16, 17 Para. 1, 18 GDPR. However, this obligation does not apply if such notification is impossible or involves a disproportionate effort. Nevertheless, users have a right to information about these recipients.</p>
<p><strong>Likewise, under Art. 21 GDPR, users and data subjects have the right to object to the controller's future processing of their data pursuant to Art. 6 Para. 1 lit. f) GDPR. In particular, an objection to data processing for the purpose of direct advertising is permissible.</strong></p>
<h3>III. Information about the data processing</h3>
<p>Your data processed when using our website will be deleted or blocked as soon as the purpose for its storage ceases to apply, provided the deletion of the same is not in breach of any statutory storage obligations or unless otherwise stipulated below.</p>

<h4>Server data</h4>
<p>For technical reasons, the following data sent by your internet browser to us or to our server provider will be collected, especially to ensure a secure and stable website: These server log files record the type and version of your browser, operating system, the website from which you came (referrer URL), the webpages on our site visited, the date and time of your visit, as well as the IP address from which you visited our site.</p>
<p>The data thus collected will be temporarily stored, but not in association with any other of your data.</p>
<p>The basis for this storage is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the improvement, stability, functionality, and security of our website.</p>
<p>The data will be deleted within no more than seven days, unless continued storage is required for evidentiary purposes. In which case, all or part of the data will be excluded from deletion until the investigation of the relevant incident is finally resolved.</p>

<h4>Cookies</h4>
<h5>a) Session cookies</h5>
<p>We use cookies on our website. Cookies are small text files or other storage technologies stored on your computer by your browser. These cookies process certain specific information about you, such as your browser, location data, or IP address. &nbsp;</p>
<p>This processing makes our website more user-friendly, efficient, and secure, allowing us, for example, to display our website in different languages or to offer a shopping cart function.</p>
<p>The legal basis for such processing is Art. 6 Para. 1 lit. b) GDPR, insofar as these cookies are used to collect data to initiate or process contractual relationships.</p>
<p>If the processing does not serve to initiate or process a contract, our legitimate interest lies in improving the functionality of our website. The legal basis is then Art. 6 Para. 1 lit. f) GDPR.</p>
<p>When you close your browser, these session cookies are deleted.</p>
<h5>b) Third-party cookies</h5>
<p>If necessary, our website may also use cookies from companies with whom we cooperate for the purpose of advertising, analyzing, or improving the features of our website.</p>
<p>Please refer to the following information for details, in particular for the legal basis and purpose of such third-party collection and processing of data collected through cookies.</p>
<h5>c) Disabling cookies</h5>
<p>You can refuse the use of cookies by changing the settings on your browser. Likewise, you can use the browser to delete cookies that have already been stored. However, the steps and measures required vary, depending on the browser you use. If you have any questions, please use the help function or consult the documentation for your browser or contact its maker for support. Browser settings cannot prevent so-called flash cookies from being set. Instead, you will need to change the setting of your Flash player. The steps and measures required for this also depend on the Flash player you are using. If you have any questions, please use the help function or consult the documentation for your Flash player or contact its maker for support.</p>
<p>If you prevent or restrict the installation of cookies, not all of the functions on our site may be fully usable.</p>

<h4>Order processing</h4>
<p>The data you submit when ordering goods and/or services from us will have to be processed in order to fulfill your order. Please note that orders cannot be processed without providing this data.</p>
<p>The legal basis for this processing is Art. 6 Para. 1 lit. b) GDPR.</p>
<p>After your order has been completed, your personal data will be deleted, but only after the retention periods required by tax and commercial law.</p>
<p>In order to process your order, we will share your data with the shipping company responsible for delivery to the extent required to deliver your order and/or with the payment service provider to the extent required to process your payment.</p>
<h5>The legal basis for the transfer of this data is Art. 6 Para. 1 lit. b) GDPR. </h5>

<h4>Customer account/registration</h4>
<p>If you create a customer account with us via our website, we will use the data you entered during registration (e.g. your name, your address, or your email address) exclusively for services leading up to your potential placement of an order or entering some other contractual relationship with us, to fulfill such orders or contracts, and to provide customer care (e.g. to provide you with an overview of your previous orders or to be able to offer you a wishlist function). We also store your IP address and the date and time of your registration. This data will not be transferred to third parties.</p>
<p>During the registration process, your consent will be obtained for this processing of your data, with reference made to this privacy policy. The data collected by us will be used exclusively to provide your customer account.&nbsp;</p>
<p>If you give your consent to this processing, Art. 6 Para. 1 lit. a) GDPR is the legal basis for this processing.</p>
<p>If the opening of the customer account is also intended to lead to the initiation of a contractual relationship with us or to fulfill an existing contract with us, the legal basis for this processing is also Art. 6 Para. 1 lit. b) GDPR.</p>
<p>You may revoke your prior consent to the processing of your personal data at any time under Art. 7 Para. 3 GDPR with future effect. All you have to do is inform us that you are revoking your consent.</p>
<p>The data previously collected will then be deleted as soon as processing is no longer necessary. However, we must observe any retention periods required under tax and commercial law.</p>

<h4>Newsletter</h4>
<p>If you register for our free newsletter, the data requested from you for this purpose, i.e. your email address and, optionally, your name and address, will be sent to us. We also store the IP address of your computer and the date and time of your registration. During the registration process, we will obtain your consent to receive this newsletter and the type of content it will offer, with reference made to this privacy policy. The data collected will be used exclusively to send the newsletter and will not be passed on to third parties.</p>
<p>The legal basis for this is Art. 6 Para. 1 lit. a) GDPR.</p>
<p>You may revoke your prior consent to receive this newsletter under Art. 7 Para. 3 GDPR with future effect. All you have to do is inform us that you are revoking your consent or click on the unsubscribe link contained in each newsletter.</p>

<h4>Contact</h4>
<p>If you contact us via email or the contact form, the data you provide will be used for the purpose of processing your request. We must have this data in order to process and answer your inquiry; otherwise we will not be able to answer it in full or at all.</p>
<p>The legal basis for this data processing is Art. 6 Para. 1 lit. b) GDPR.</p>
<p>Your data will be deleted once we have fully answered your inquiry and there is no further legal obligation to store your data, such as if an order or contract resulted therefrom.</p>

<h4>User posts, comments, and ratings</h4>
<p>We offer you the opportunity to post questions, answers, opinions, and ratings on our website, hereinafter referred to jointly as "posts." If you make use of this opportunity, we will process and publish your post, the date and time you submitted it, and any pseudonym you may have used.</p>
<p>The legal basis for this is Art. 6 Para. 1 lit. a) GDPR. You may revoke your prior consent under Art. 7 Para. 3 GDPR with future effect. All you have to do is inform us that you are revoking your consent.</p>
<p>In addition, we will also process your IP address and email address. The IP address is processed because we might have a legitimate interest in taking or supporting further action if your post infringes the rights of third parties and/or is otherwise unlawful.</p>
<p>In this case, the legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in any legal defense we may have to mount.</p>

<h4>Follow-up comments</h4>
<p>If you make posts on our website, we also offer you the opportunity to subscribe to any subsequent follow-up comments made by third parties. In order to be able to inform you about these follow-up comments, we will need to process your email address.</p>
<p>The legal basis for this is Art. 6 Para. 1 lit. a) GDPR. You may revoke your prior consent to this subscription under Art. 7 Para. 3 GDPR with future effect. All you have to do is inform us that you are revoking your consent or click on the unsubscribe link contained in each email.</p>

<h4>Google Analytics</h4>
<p>We use Google Analytics on our website. This is a web analytics service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>The Google Analytics service is used to analyze how our website is used. The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the analysis, optimization, and economic operation of our site.</p>
<p>Usage and user-related information, such as IP address, place, time, or frequency of your visits to our website will be transmitted to a Google server in the United States and stored there. However, we use Google Analytics with the so-called anonymization function, whereby Google truncates the IP address within the EU or the EEA before it is transmitted to the US.</p>
<p>The data collected in this way is in turn used by Google to provide us with an evaluation of visits to our website and what visitors do once there. This data can also be used to provide other services related to the use of our website and of the internet in general.</p>
<p>Google states that it will not connect your IP address to other data. In addition, Google provides further information with regard to its data protection practices at</p>
<p><a href="https://www.google.com/intl/de/policies/privacy/partners" target="_blank" rel="noopener">https://www.google.com/intl/de/policies/privacy/partners,</a></p>
<p>including options you can exercise to prevent such use of your data.</p>
<p>In addition, Google offers an opt-out add-on at</p>
<p><a href="https://tools.google.com/dlpage/gaoptout?hl=de" target="_blank" rel="noopener">https://tools.google.com/dlpage/gaoptout?hl=en</a></p>
<p>in addition with further information. This add-on can be installed on the most popular browsers and offers you further control over the data that Google collects when you visit our website. The add-on informs Google Analytics' JavaScript (ga.js) that no information about the website visit should be transmitted to Google Analytics. However, this does not prevent information from being transmitted to us or to other web analytics services we may use as detailed herein.</p>

<h4>Google+ plug-in</h4>
<p>We use the plug-in of the Google+ social network on our website. Google+ is an online service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in improving the quality of our website.</p>
<p>Further information about the possible plug-ins and their respective functions is available from Google at</p>
<p><a href="https://developers.google.com/+/web/" target="_blank" rel="noopener">https://developers.google.com/+/web/</a>&nbsp;</p>
<p>If the plug-in is stored on one of the pages you visit on our website, your browser will download an icon for the plug-in from Google's servers in the USA. For technical reasons, it is necessary for Google to process your IP address. In addition, the date and time of your visit to our website will also be recorded.</p>
<p>If you are logged in to Google while visiting one of our plugged-in websites, the information collected by the plug-in from your specific visit will be recognized by Google. The information collected may then be assigned to your personal account at Google. If, for example, you use the +1 button, this information will be stored in your Google Account and may be published on the Google platform. To prevent this, you must either log out of Google before visiting our site or make the appropriate settings in your Google account.</p>
<p>Further information about the collection and use of data as well as your rights and protection options in Google's privacy policy found at</p>
<p><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>

<h4>Google-Maps</h4>
<p>Our website uses Google Maps to display our location and to provide directions. This is a service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>To enable the display of certain fonts on our website, a connection to the Google server in the USA is established whenever our website is accessed.</p>
<p>If you access the Google Maps components integrated into our website, Google will store a cookie on your device via your browser. Your user settings and data are processed to display our location and create a route description. We cannot prevent Google from using servers in the USA.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in optimizing the functionality of our website.</p>
<p>By connecting to Google in this way, Google can determine from which website your request has been sent and to which IP address the directions are transmitted.</p>
<p>If you do not agree to this processing, you have the option of preventing the installation of cookies by making the appropriate settings in your browser. Further details can be found in the section about cookies above.</p>
<p>In addition, the use of Google Maps and the information obtained via Google Maps is governed by the <a href="http://www.google.de/accounts/TOS" target="_blank" rel="noopener">Google Terms of Use</a> <a href="https://policies.google.com/terms?gl=DE&amp;hl=de" target="_blank" rel="noopener">https://policies.google.com/terms?gl=DE&amp;hl=en</a> and the <a href="http://www.google.com/intl/de_de/help/terms_maps.html" target="_blank" rel="noopener">Terms and Conditions for Google Maps</a> https://www.google.com/intl/de_de/help/terms_maps.html.</p>
<p>Google also offers further information at</p>
<p><a href="https://adssettings.google.com/authenticated" target="_blank" rel="noopener">https://adssettings.google.com/authenticated</a></p>
<p><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>

<h4>Google Fonts</h4>
<p>Our website uses Google Fonts to display external fonts. This is a service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>To enable the display of certain fonts on our website, a connection to the Google server in the USA is established whenever our website is accessed.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the optimization and economic operation of our site.</p>
<p>When you access our site, a connection to Google is established from which Google can identify the site from which your request has been sent and to which IP address the fonts are being transmitted for display.</p>
<p>Google offers detailed information at</p>
<p><a href="https://adssettings.google.com/authenticated" target="_blank" rel="noopener">https://adssettings.google.com/authenticated</a></p>
<p><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>
<p>in particular on options for preventing the use of data.</p>

<h4>Facebook plug-in</h4>
<p>Our website uses the plug-in of the Facebook social network. Facebook.com is a service provided by Facebook Inc., 1601 S. California Ave, Palo Alto, CA 94304, USA. In the EU, this service is also operated by Facebook Ireland Limited, 4 Grand Canal Square, Dublin 2, Ireland, hereinafter both referred to as "Facebook."</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active</a></p>
<p>Facebook guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in improving the quality of our website.</p>
<p>Further information about the possible plug-ins and their respective functions is available from Facebook at</p>
<p><a href="https://developers.facebook.com/docs/plugins/" target="_blank" rel="noopener">https://developers.facebook.com/docs/plugins/</a></p>
<p>If the plug-in is stored on one of the pages you visit on our website, your browser will download an icon for the plug-in from Facebook's servers in the USA. For technical reasons, it is necessary for Facebook to process your IP address. In addition, the date and time of your visit to our website will also be recorded.</p>
<p>If you are logged in to Facebook while visiting one of our plugged-in websites, the information collected by the plug-in from your specific visit will be recognized by Facebook. The information collected may then be assigned to your personal account at Facebook. If, for example, you use the Facebook Like button, this information will be stored in your Facebook account and published on the Facebook platform. If you want to prevent this, you must either log out of Facebook before visiting our website or use an add-on for your browser to prevent the Facebook plug-in from loading.</p>
<p>Further information about the collection and use of data as well as your rights and protection options in Facebook's privacy policy found at</p>
<p><a href="https://www.facebook.com/policy.php" target="_blank" rel="noopener">https://www.facebook.com/policy.php</a></p>

<h4>YouTube</h4>
<p>We use YouTube on our website. This is a video portal operated by YouTube LLC, 901 Cherry Ave, 94066 San Bruno, CA, USA, hereinafter referred to as "YouTube".</p>
<p>YouTube is a subsidiary of Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043 USA, hereinafter referred to as "Google".</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google and its subsidiary YouTube guarantee that they will follow the EU's data protection regulations when processing data in the United States.</p>
<p>We use YouTube in its advanced privacy mode to show you videos. The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in improving the quality of our website. According to YouTube, the advanced privacy mode means that the data specified below will only be transmitted to the YouTube server if you actually start a video.</p>
<p>Without this mode, a connection to the YouTube server in the USA will be established as soon as you access any of our webpages on which a YouTube video is embedded.</p>
<p>This connection is required in order to be able to display the respective video on our website within your browser. YouTube will record and process at a minimum your IP address, the date and time the video was displayed, as well as the website you visited. In addition, a connection to the DoubleClick advertising network of Google is established.</p>
<p>If you are logged in to YouTube when you access our site, YouTube will assign the connection information to your YouTube account. To prevent this, you must either log out of YouTube before visiting our site or make the appropriate settings in your YouTube account.</p>
<p>For the purpose of functionality and analysis of usage behavior, YouTube permanently stores cookies on your device via your browser. If you do not agree to this processing, you have the option of preventing the installation of cookies by making the appropriate settings in your browser. Further details can be found in the section about cookies above.</p>
<p>Further information about the collection and use of data as well as your rights and protection options in Google's privacy policy found at</p>
<p><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>

<h4>etracker web analytics</h4>
<p>We use etracker on our website. This is a web analytics service provided by etracker GmbH, Erste Brunnenstr. 1, 20459 Hamburg, hereinafter referred to as "etracker".</p>
<p>etracker is used to analyze how our website is used. The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the analysis, optimization, and economic operation of our site.</p>
<p>To analyze usage behavior, etracker stores cookies on your device via your browser and creates a pseudonymous usage profile. However, the data processed in this way will not be used to identify you personally without your separate consent nor will this data be merged with other personal data.</p>
<p>If you do not agree to this processing, you have the option of preventing the installation of cookies by making the appropriate settings in your browser. Further details can be found in the section about cookies above.</p>
<p>In addition, you have the option of terminating the analysis of your usage behavior by opting out. By confirming the link</p>
<p><a href="http://www.etracker.de/privacy?et=V23Jbb" target="_blank" rel="noopener">http://www.etracker.de/privacy?et=V23Jbb</a></p>
<p>a cookie is stored on your device via your browser to prevent any further analysis. Please note, however, that you must click the above link again if you delete the cookies stored on your end device.</p>

<h4>Shariff social media buttons</h4>
<p>Our website uses the plug-ins of the following social networks. To integrate these plug-ins, we use the Shariff plug-in.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in improving the quality of our website.</p>
<p>Shariff is an open source program developed by c't and heise. By integrating this plug-in, linked graphics prevent the following social network plug-ins from automatically establishing a connection to the respective social networks server when you visit website(s) on which the plug-ins are integrated. Only if you click on one of these linked graphics will you be forwarded to the service of the respective social network. Only then will information about your use of our site be recorded by the respective social network. This information may include your IP address, the date and time you visited our site, as well as the pages you viewed.</p>
<p>If you are logged in to one of the social network services while visiting one of our plugged-in websites, the information collected by the plug-in from your specific visit will be recognized by the provider of that social network and assigned to your personal user account there and/or publish information about your interaction with our site there. If, for example, you use the a share button for the social network, this information may be stored in your user account there and published on the platform of the respective social network provider. To prevent this, you must either log out of the social network before clicking the graphic or make the appropriate settings in your social network account.</p>
<p>Further information about Shariff is available at</p>
<p><a href="http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html" target="_blank" rel="noopener">http://www.heise.de/ct/artikel/Shariff-Social-Media-Buttons-mit-Datenschutz-2467514.html</a></p>
<p>The following social networks are integrated into our website:</p>
<p><strong>Google+</strong> operated by Google LLC, 1600 Amphitheatre Parkway, Mountain View, California, 94043, USA.</p>
<p>Privacy information is available at <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p><strong>Facebook</strong> operated by Facebook Inc, 1601 S. California Ave, Palo Alto, CA 94304, USA, operated within the EU by Facebook Ireland Limited, 4 Grand Canal Square, Dublin 2, Ireland.&nbsp;</p>
<p>Privacy information can be found at <a href="https://www.facebook.com/policy.php" target="_blank" rel="noopener">https://www.facebook.com/policy.php</a></p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&amp;status=Active</a></p>
<p>Facebook guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p><strong>Twitter</strong> operated by Twitter Inc, 795 Folsom St., Suite 600, San Francisco, CA 94107, USA.</p>
<p>Privacy information can be found at <a href="https://twitter.com/privacy" target="_blank" rel="noopener">https://twitter.com/privacy</a></p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt0000000TORzAAO&amp;status=Active</a></p>
<p>Twitter guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>

<h4>Google AdWords with Conversion Tracking</h4>
<p>Our website uses Google AdWords and conversion tracking. This is a service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>We use conversion tracking to provide targeted promotion of our site. The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the analysis, optimization, and economic operation of our site.</p>
<p>If you click on an ad placed by Google, the conversion tracking we use stores a cookie on your device. These so-called conversion cookies expire after 30 days and do not otherwise identify you personally.</p>
<p>If the cookie is still valid and you visit a specific page of our website, both we and Google can evaluate that you clicked on one of our ads placed on Google and that you were then forwarded to our website.</p>
<p>The data collected in this way is in turn used by Google to provide us with an evaluation of visits to our website and what visitors do once there. In addition, we receive information about the number of users who clicked on our advertisement(s) as well as about the pages on our site that are subsequently visited. Neither we nor third parties who also use Google AdWords will be able to identify you from this conversion tracking.</p>
<p>You can also prevent or restrict the installation of cookies by making the appropriate settings in your browser. Likewise, you can use the browser to delete cookies that have already been stored. However, the steps and measures required vary, depending on the browser you use. If you have any questions, please use the help function or consult the documentation for your browser or contact its maker for support.</p>
<p>In addition, Google provides further information with regard to its data protection practices at</p>
<p><a href="https://services.google.com/sitestats/de.html" target="_blank" rel="noopener">https://services.google.com/sitestats/de.html</a></p>
<p><a href="http://www.google.com/policies/technologies/ads/" target="_blank" rel="noopener">http://www.google.com/policies/technologies/ads/</a>&nbsp;</p>
<p><a href="http://www.google.de/policies/privacy/" target="_blank" rel="noopener">http://www.google.de/policies/privacy/</a></p>
<p>in particular information on how you can prevent the use of your data.</p>

<h4>Google AdSense</h4>
<p>We use Google AdSense on our website to integrate advertisements. This is a service provided by Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043 (hereinafter: Google).</p>
<p>Through certification according to the EU-US Privacy Shield</p>
<p><a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active" target="_blank" rel="noopener">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&amp;status=Active</a></p>
<p>Google guarantees that it will follow the EU's data protection regulations when processing data in the United States.</p>
<p>Google AdSense stores cookies and web beacons on your device via your browser. This enables Google to analyze how you use our website. In addition to your IP address and the advertising formats displayed, the information thus collected will be transmitted to Google in the USA and stored there. Google may also share this information with third parties. Google states that it will not connect your IP address to other data.</p>
<p>The legal basis is Art. 6 Para. 1 lit. f) GDPR. Our legitimate interest lies in the analysis, optimization, and economic operation of our site.</p>
<p>If you do not agree to this processing, you have the option of preventing the installation of cookies by making the appropriate settings in your browser. Further details can be found in the section about cookies above.</p>
<p>In addition, Google offers an opt-out add-on at</p>
<p><a href="https://policies.google.com/privacy" target="_blank" rel="noopener">https://policies.google.com/privacy</a></p>
<p><a href="https://adssettings.google.com/authenticated" target="_blank" rel="noopener">https://adssettings.google.com/authenticated</a></p>
<p>in particular on options for preventing the use of data.</p>

<h4>affilinet tracking cookies</h4>
<p>We also advertise third-party offers and services on our website. If you enter into a contract with the third party after viewing our advertising for these third party offers, we will receive a commission for this referral.</p>
<p>We use the affilinet tracking cookie to record this successful conversion. However, this cookie does not store any of your personal data. Only our identification number as the affiliate advertiser and the serial number of the advertising material you clicked on (e.g. a banner or a text link) are recorded. We need this information for the purpose of processing and/or receiving payment of our commissions.</p>
<p>If you do not agree to this processing, you have the option of preventing the installation of cookies by making the appropriate settings in your browser. Further details can be found in the section about cookies above.</p>

<!--
<p><a href="https://www.ratgeberrecht.eu/leistungen/muster-datenschutzerklaerung.html" target="_blank" rel="noopener">Model Data Protection Statement</a> for <a href="https://www.ratgeberrecht.eu/" target="_blank">Anwaltskanzlei Weiß &amp; Partner</a></p>
-->
<?php } ?>

<?php  
include $tpl .'footer.php' ;  
?>