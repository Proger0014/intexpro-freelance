import { Header } from "../components/header";
import { banner as sbanner } from "../assets/styles";
import { Container, Flex } from "@mantine/core";

function HomeLayout({ main, banner }) {
  return (
    <div>
      <div className={sbanner.banner}>
        <Header isTransparent py={29} h="20%" />

        <Container size="xl" h="80%" >
          <Flex align="center" h="100%">
            <div className={sbanner.content}>
              {banner}
            </div>
          </Flex>
        </Container>
      </div>
      <main>
        {main}
      </main>
    </div>
  )
}

export default HomeLayout;