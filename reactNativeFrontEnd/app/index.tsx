import { Text, View, StyleSheet, TouchableOpacity, ImageBackground } from "react-native";
import { Link, useRouter } from "expo-router";

export default function Index() {
  const router = useRouter();
  return (
    <ImageBackground source={require('../assets/images/money.png')}
    style={{
      flex: 1,
      justifyContent: "center"
    }}>
    <View
      style={{
        flex: 1,
        justifyContent: "center",
        alignItems:'center'
      }}
    >
                    <Text
               style={{
                width: "90%",
                padding:20,
                borderTopLeftRadius: 20,
                borderTopRightRadius: 20,
                backgroundColor: 'rgba(20,120,70,0.7)',
                color: 'rgba(250,250,250,0.85)',
                lineHeight: 40,
                fontSize: 21.5,
                textAlign: "center",
              }}>Saving and Borrowing System from local association</Text>
                    <Text
                    style={{
                      borderBottomLeftRadius: 100,
                      borderBottomRightRadius: 100,
                      width:"90%",
                      height: "10%",
                      backgroundColor: 'rgba(20,120,70,0.7)',
                      fontWeight:"bold",
                      color: 'rgba(250,250,250,0.85)',
                      lineHeight: 30,
                      fontSize: 29,
                      textAlign: "center",
                  }}
              >( KIKOBA )</Text>         
      <View 
        style={{
          backgroundColor: 'rgba(20,120,70,0.9)',
          paddingVertical: 12,
          paddingHorizontal: 30,
          borderRadius: 8,
          marginTop: 50,
          width:170,
          alignSelf:"center",
      }}
      >
      <TouchableOpacity>
      <Text
      style={{
        fontSize: 20,
        textAlign: "center",
        fontWeight: 'bold',
        marginBottom: 10,
        color: "rgb(220,228,220)",
      }}><Link href="/SignIn">Join now</Link></Text>
      </TouchableOpacity>
      </View>
    </View>
    </ImageBackground>
  );
}

const styles = StyleSheet.create({
  topText:{
      color: "white",
      //fontFamily: "Apple Color Emoji",
      fontSize: 35,
  },

  submitButtonText:{
      textAlign: "center",
      color: "white",
      fontSize: 20,
  },
})
