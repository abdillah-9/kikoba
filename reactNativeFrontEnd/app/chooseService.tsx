import { Link, useLocalSearchParams, usePathname, useNavigation, useRouter } from "expo-router";
import { Text,TextInput, View, StyleSheet, Button, TouchableOpacity } from "react-native";


export default function chooseService(){
    const router = useRouter();
    const id = useLocalSearchParams();
    const id2 = id.id;
    return(
        <View style={styles.mainContainer}>
            <View style={styles.container}>
            <View style={styles.top}>
            <Text style={styles.topText}>Choose service</Text>
            </View>                                            

            {/* Below are the links to transactions */}
            <View style={styles.formContainer}>

            {/* RETURN LOAN BUTTON (go to returnLoan page) */}
            <TouchableOpacity 
            style={[styles.submitButton, styles.blueBackground]}>
            <Link href={{ pathname:'viewBalance', params: { id:id2} }}
            style={styles.submitButtonText}>View Balance</Link>
            </TouchableOpacity>
            {/* -------------------- */}
            
            {/* CONTRIBUTE BUTTON (go to contribution page) */}
            <TouchableOpacity 
            style={[styles.submitButton, styles.greenBackground]}>
            <Link href={{ pathname:'contribute', params: { id:id2} }}
            style={styles.submitButtonText}>Contribute</Link>    
            </TouchableOpacity>
            {/* -------------------- */}

            {/* RETURN LOAN BUTTON (go to returnLoan page) */}
            <TouchableOpacity 
            style={[styles.submitButton, styles.yellowBackground]}>
            <Link href={{ pathname:'receiveLoan', params: {id:id2} }}
            style={styles.submitButtonText}>Receive Loan</Link>
            </TouchableOpacity>
            {/* -------------------- */}

            {/* RETURN LOAN BUTTON (go to returnLoan page) */}
            <TouchableOpacity 
            style={[styles.submitButton, styles.orangeBackground]}>
            <Link href={{ pathname:'returnLoan', params: {id:id2} }}
            style={styles.submitButtonText}>Return loan</Link>
            </TouchableOpacity>
            {/* -------------------- */}

            </View>
        </View>
    </View>
    )
}

const styles = StyleSheet.create({
    mainContainer:{
        flex:1,
        backgroundColor:"rgb(20,78,120)",
        alignItems: "center",
        justifyContent: "center",
        //fontFamily: "SpaceMono-Regular",
    },

    container:{
        flex:0.7,
        width: "80%",
        //fontFamily: "Apple Color Emoji",
        alignItems: "center",
        padding:20,
        justifyContent:"space-evenly",
    },
    top:{
        justifyContent: "center", 
        color: "white",
        //fontFamily: "Apple Color Emoji",
        borderBottomWidth: 2,
        borderBottomColor: "rgba(230,230,230,0.75)",
        padding: 3,
        borderRadius: 20,
        marginBottom: 20,
    },

    topText:{
        color: "white",
        //fontFamily: "Apple Color Emoji",
        fontSize: 30,
    },

    formContainer:{
        flex: 1,
        //fontFamily: "Apple Color Emoji",
        flexDirection: "column",
        justifyContent:"space-evenly"
    },
    submitButton:{
        //fontFamily: "Apple Color Emoji",
        fontSize: 30,
        borderColor: "rgba(230,230,230,0.75)",
        borderWidth: 1,
        borderRadius: 20,
        paddingVertical: 10,
        paddingHorizontal: 20,
        backgroundColor: "rgb(20,20,50)",
    },
    submitButtonText:{
        textAlign: "center",
        color: "white",
        fontSize: 20,
    },

    blueBackground:{
        backgroundColor: "rgba(30,50,120,1)",
    },
    
    greenBackground:{
        backgroundColor: "rgba(30,120,50,1)",
    },
    
    yellowBackground:{
        backgroundColor: "rgba(120,120,30,1)",
    },
    
    orangeBackground:{
        backgroundColor: "rgba(170,50,30,1)",
    },
})